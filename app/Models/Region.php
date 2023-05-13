<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "img"
    ];
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
