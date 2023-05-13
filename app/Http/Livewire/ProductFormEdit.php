<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;


class ProductFormEdit extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $region_id;
    public $temporary_images;
    public $images = [];
    public $is_in_promotion;
    public $is_accepted;
    //variabili per controllare il tempo di caricamento dei prodotti e Carbon
    public $product;
    public $userProduct;
    public $tempo;
    public $autofillDone = false;

    public function autoFill($product)
    {
        // dd($product->images);
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->region_id = $product->region_id;
        $this->price = $product->price;
        // $this->images = $product->images->id;
        $this->is_in_promotion = $product->is_in_promotion;
        $this->temporary_images = $product->images;
        $this->tempo = $this->promotion($product);
        // $this->updatedTemporaryImages();
    }
    protected $rules = [
        'name' => 'required|min:4',
        'description' => 'required|min:10',
        'category_id' => 'required',
        'region_id' => 'required',
        'price' => 'required',
        'is_in_promotion' => "nullable",
        'temporary_images' => 'nullable|array',
        'is_accepted' => "nullable"

    ];
    protected $messages = [
        'required' => 'Questa voce è richiesta',
        'title.required' => 'Il tuo titolo è troppo corto',
        'description.required' => 'La tua descrizione inserita è troppo corta',

    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    // Controlla se dalla data di creazione sono passati tot giorni
    public function promotion($product)
    {
        return Carbon::now()->diffInDays($product->created_at) >= 0;
    }

    public function updateArticle()
    {
        $this->validate();
        $product = Product::findOrFail($this->userProduct->id);
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'region_id' => $this->region_id,
            'is_in_promotion' => $this->is_in_promotion,
            'is_accepted' => NULL,
            'revisor_id' => NULL,

            // 'image'=>$this->image,      
        ]);
        //   Controllo Immagini per l'edit      
        if (count($this->images)) {
            foreach ($this->images as $image) {
                $imagePath = ['path' => $image->store('images', 'public')];
                $img = $product->images()->create($imagePath);
                RemoveFaces::withChain([
                    new ResizeImage($img->path, 900, 600),
                ])->dispatch($img->id);
            }
        } else {
            if (!$product->images()->exists()) {
                $imagePath = ['path' => 'images/default.png'];
                $img = $product->images()->create($imagePath);
            }
        }

        $product->save();
        $this->reset();
        return redirect()
            ->route('homepage')
            ->with("message", "Articolo modificato correttamente. Attendi l'approvazione da parte di un revisore");
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:2024',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function cancelImage(Image $image)
    {
        $image->delete();
        return redirect(request()->header('Referer'));
    }


    public function render()
    {
        if (!$this->autofillDone && $this->userProduct) {
            $this->autoFill($this->userProduct);
        }
        // dd($this->userProduct);
        return view('livewire.product-form-edit', [
            'tempo' => $this->tempo,
            $this->autofillDone = true
        ]);
    }
}
