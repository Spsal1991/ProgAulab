<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function homepage()
    {
        //$products = Product::take(6)->get()->sortByDesc('price');
        $products = Product::where('is_accepted', true)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
        $productsPrice = Product::where('is_accepted', true)
            ->orderBy('price')
            ->take(4)
            ->get();
        $productsRegion = [];
        if (Auth::user()) {
            $productsRegion = Product::where('is_accepted', true)->whereNotNull('region_id')
                ->where("region_id", '=', Auth::user()->region_id)->take(4)->get();
        }
        $products_promotion = Product::where('is_accepted', true)->whereNotNull('is_in_promotion')
            ->where('is_in_promotion', '!=', 0)->take(4)
            ->get();
        return view('welcome', compact('products', 'productsPrice', 'products_promotion', "productsRegion"));
    }

    public function categoryShow(Category $category)
    {
        $products = $category->products()->where('is_accepted', true)->paginate(8);

        return view('categoryShow', compact('category', 'products'));
    }


    public function regionShow(Region $region)
    {
        $products = $region->products()->where('is_accepted', true)->paginate(8);

        return view('regionShow', compact('region', 'products'));
    }


    // Funzione per cercare i prodotti
    public function searchProducts(Request $request)
    {
        $products = Product::search($request->searched)->where('is_accepted', true)->paginate(10);
        return view('products/index', compact('products'));
    }

    public function setLanguage($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
