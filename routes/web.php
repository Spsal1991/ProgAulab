<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RevisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Rotta Homepage
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');


//Rotta Parametrica per le Categorie
Route::get('/categoria/{category}', [PublicController::class, 'categoryShow'])
    ->name('categoryShow');

// Rotta Parametrica per Regione
Route::get('/regione/{region}', [PublicController::class, 'regionShow'])
    ->name('regionShow');
//Rotta per Tutti i Prodotti
Route::get("/products/index", [ProductController::class, "index"])->name("products.index");

//Rotta Parametrica per il dettaglio dei Prodotti
Route::get('/dettaglio/product/{product}', [ProductController::class, 'show'])->name('product.show');

//Rotta Parametrica di tutti i Prodotti-Utente-loggato
Route::get("/user/indexProdotti", [ProductController::class, "userProdotti"])->name("user.indexProdotti");
//Rotta Parametrica specifica di per modificare il prodotto dell'utente Loggato
Route::get('/user/prodotto/{id}', [ProductController::class, 'userProdDettaglio'])->name('user.prodottoDettaglio');



//Middleweare for Revisors
Route::middleware(["isRevisor"])->group(function () {

    // Rotta per Pagina index del Revisore - Dove può controllare ogni prodotto da gestire
    Route::get("/revisor/home", [RevisorController::class, "index"])->name("revisor.index");
    //rotta Accetta Prodotto
    Route::patch("/accetta/prodotto/{product}", [RevisorController::class, "acceptProduct"])->name("revisor.accept_product");
    //rotta rifiuta Prodotto
    Route::patch("/rifiuta/prodotto/{product}", [RevisorController::class, "rejectProduct"])->name("revisor.reject_product");
    //Rotta per vedere ogni dettaglio del prodotto da accettare - come revisore
    Route::get('/revisor/prodotto/{id}', [RevisorController::class, 'prodottoDettaglio'])->name('revisor.prodottoDettaglio');
});



//Middleware Che permette solo agli utenti loggati a vedere/gestire deterimate richieste
Route::middleware(["auth"])->group(function () {
    // Rotta per creare il Prodotto
    Route::get("/products/create", [ProductController::class, "create"])->name("product.create");

    // Rotta per richiedere di diventare revisore
    Route::get("/richiesta/revisore", [RevisorController::class, "becomeRevisor"])->name("become.revisor");

    // Rotta per la vista modifica del profilo utente
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    //Rotta per inviare i dati per modificare il profilo Utente
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
});


// Rendi utente revisore
Route::get("/rendi/revisore/{user}", [RevisorController::class, "makeRevisor"])->name("make.revisor");

//Ricerca Prodotto
Route::get("/products/search", [PublicController::class, "searchProducts"])->name("products.search");

//*Cambio Lingua
Route::post("/lingua/{lang}", [PublicController::class, "setLanguage"])->name("set_language_locale");
