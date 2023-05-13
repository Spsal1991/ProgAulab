<?php

namespace App\Http\Livewire;

use App\Models\Region;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductForm extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $category;
    public $region;
    public $temporary_images;
    public $images = [];
    public $product;

    protected $rules = [
        'name' => 'required|min:4',
        'description' => 'required|min:10',
        'category' => 'required',
        'region' => 'required',
        'price' => 'required',
        'images.*' => 'image|max:1024',
        'temporary_images.*' => 'image|max:1024',
    ];

    protected $messages = [
        'required' => 'Questa voce è richiesta',
        'title.required' => 'Il tuo titolo è troppo corto',
        'description.required' => 'La tua descrizione inserita è troppo corta',
        'temporary_images.required' => "L'immagine è richiesta",
        'temporary_images.*.image' => 'I file devono essere immagini',
        'temporary_images.*.max' => "L'immagine dev'essere di massimo 1Mb",
        'images.image' => "Il file dev'essere un immagine",
        'images.max' => "L'immagine dev'essere massimo di 1Mb",
    ];
    //attribuisce il valore delle Temporary-Images all'images del prodotto
    public function updatedTemporaryImages()
    {
        if (
            $this->validate([
                'temporary_images.*' => 'image|max:1024',
            ])
        ) {
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Funzione store del form product-form in livewire
    public function store()
    {
        $validatedData = $this->validate();

        if (!$this->category) {
            $this->addError('category', __('productform.select_category'));
            return;
        }

        // Create a new product
        $this->product = new Product($validatedData);

        // Associate the product with the user
        $this->product->user()->associate(Auth::user());

        // Find the region and the category
        $region = Region::find($this->region);
        $category = Category::find($this->category);

        // Associate the product with the region and the category
        $this->product->region()->associate($region);
        $this->product->category()->associate($category);

        // Save the product
        $this->product->save();

        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $imagePath = ['path' => $image->store('images', 'public')];
                $img = $this->product->images()->create($imagePath);

                RemoveFaces::withChain([
                    new ResizeImage($img->path, 900, 600),
                    new GoogleVisionSafeSearch($img->id),
                    new GoogleVisionLabelImage($img->id)
                ])->dispatch($img->id);
            }
        } else {
            // Aggiungi qui il percorso dell'immagine di default
            $imagePath = ['path' => 'images/default.png'];
            $img = $this->product->images()->create($imagePath);
            dispatch(new ResizeImage($img->path, 900, 600));
            dispatch(new GoogleVisionSafeSearch($img->id));
            dispatch(new GoogleVisionLabelImage($img->id));
        }
        session()->flash('message', 'Prodotto caricato con successo, sarà pubblicato dopo la revisione');
        $this->cleanForm();

        $this->product->user()->associate(Auth::user());
        $this->product->save();
        $this->reset();

        return redirect()
            ->route('homepage')
            ->with('message', 'Il tuo prodotto è in attesa di approvazione');
    }

    public function cleanForm()
    {
        $this->name = '';
        $this->description = '';
        $this->category = '';
        $this->price = '';
        $this->images = [];
        $this->temporary_images = [];
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
