<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Models\Order;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;

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

// Rota do Dashboard inteligente, que alimenta o histórico de pedidos do usuário atual
Route::get('/dashboard', function () {
    $myOrders = Order::where('user_id', auth()->id())->latest()->get();
    return view('dashboard', compact('myOrders'));
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

// Rotas Finalização de Compra - Protegidas por Login
Route::post('/carrinho/finalizar', [CartController::class, 'checkout'])
    ->middleware('auth')
    ->name('cart.checkout');

// Rotas exclusivas para o Administrador logado
Route::middleware(['auth', 'admin'])->group(function () {

    // Rotas de Pedidos do Admin
    Route::get('/admin/pedidos', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/pedidos/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update');

    // Rotas de Produtos do Admin
    Route::get('/admin/produtos', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/produtos/novo', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/produtos', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/produtos/{id}/editar', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/produtos/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/produtos/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
});
require __DIR__.'/auth.php';
