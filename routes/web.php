<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

Route::get('/', function (Request $request) {
    $countries = Country::all();
    $query = Product::with('country');
    
    // Variável para guardar o país atual do filtro
    $selectedCountry = null;

    if ($request->has('pais')) {
        $query->where('country_id', $request->pais);
        // Busca os detalhes do país selecionado
        $selectedCountry = Country::find($request->pais);
    }

    $products = $query->get();

    // Passamos também o $selectedCountry para a tela
    return view('welcome', compact('products', 'countries', 'selectedCountry'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Grupo de rotas do Vendedor Protegidas por Login e pelo nosso Middleware Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rota principal do painel (Dashboard do admin)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Rotas do CRUD de Produtos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
});

// Rotas do Carrinho de Compras
Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

require __DIR__.'/auth.php';
