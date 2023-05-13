<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Region;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        "name",
        "description",
        "price",
        "user_id",
        "category_id",
        "region_id",
        "is_in_promotion",
        "is_accepted",
        'revisor_id'
    ];

    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "category" => $category,
        ];
        return $array;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->revisor_id = Auth::user()->id;
        $this->save();
        return true;
    }
    public static function toBeRevisionedCount()
    {
        return Product::where("is_accepted", null)->count();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Funzione per la promozione
    public function getPriceInPromotion()
    {
        if ($this->is_in_promotion) {
            $sconto = $this->price * ($this->is_in_promotion / 100);
            return ($this->price - $sconto);
        } else {
            return $this->price;
        }
    }
}
