<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Mail\BecomeRevisor;

class RevisorController extends Controller
{
    public function index()
    {
        $products_to_check = Product::where("is_accepted", null)->orderByDesc('created_at')->paginate(3)->withQueryString();
        $products_accepted = Product::where("revisor_id", Auth::user()->id)->where("is_accepted", true)->orderByDesc('created_at')->paginate(3, ['*'], 'products_accepted_page')->withQueryString();
        $products_rejected = Product::where("revisor_id", Auth::user()->id)->where("is_accepted", false)->orderByDesc('created_at')->paginate(3, ['*'], 'products_rejected_page')->withQueryString();


        return view("revisor/index", compact("products_to_check", "products_accepted", "products_rejected"));
    }

    public function acceptProduct(Product $product)
    {
        $product->setAccepted(true);
        return redirect()->route('revisor.index')->with("message", "Complimenti, hai verificato e accettato un Prodotto!");
    }
    public function rejectProduct(Product $product)
    {
        $product->setAccepted(false);
        return redirect()->route('revisor.index')->with("message", "Complimenti, hai verificato e rifiutato un Prodotto!");
    }

    public function becomeRevisor()
    {
        Mail::to("admin@app.it")->send(new BecomeRevisor(Auth::user()));
        return redirect()->back()->with("message", "Bravo! Hai richiesto di diventare Revisore");
    }

    public function makeRevisor(User $user)
    {
        Artisan::call('app:make-user-revisor', ["email" => $user->email]);
        return redirect('/')->with('message', "Complimenti l'utente è diventato revisore!");
    }

    public function prodottoDettaglio($id)
    {
        $product = Product::find($id);
        return view('revisor.dettaglio', compact('product'));
    }
}
