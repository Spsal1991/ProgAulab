<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ["path"];

    protected $casts = [

        'labels' => 'array'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public static function getUrlByFilePath($filepath)
    {
        $path = dirname($filepath);
        $filename = basename($filepath);
        $file = "{$path}/crop_{$filename}";
        return Storage::url($file);
    }
    public function getUrl()
    {

        return Image::getUrlByFilePath($this->path);
    }
}
