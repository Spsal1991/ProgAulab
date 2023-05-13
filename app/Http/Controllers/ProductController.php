<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::where("is_accepted", true)->orderByDesc('created_at')->paginate(12);
        // $products = Product::paginate(5);
        return view("/products/index", compact("products"));
    }

    // Funzioni per pagina User Prodotti e Dettaglio User Prodotti

    public function userProdotti()
    {
        $productsUser = [];
        if (Auth::user()->products) {
            $productsUser = Product::where("user_id", '=', Auth::user()->id)->orderByDesc('created_at')->paginate(8);
        }
        return view("auth/prodotti-utente", compact("productsUser"));
    }

    public function userProdDettaglio($id)
    {
        $userProduct = Product::find($id);
        return view('auth.prodotto-dettaglio', compact('userProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("/products/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */

    // Rotta Parametrica per il dettaglio Prodotto
    public function show(Product $product, Category $category)
    {
        // Prodotti che hanno la stessa categoria e sono diversi dal prodotto in dettaglio 
        $productsCategory = Product::where('is_accepted', true)->where("id", '!=', $product->id)->where("category_id", '=', $product->category_id)
            ->get();
        return view('products/show', compact('product', "productsCategory"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
