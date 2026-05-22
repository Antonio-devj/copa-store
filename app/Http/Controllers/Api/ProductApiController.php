<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    // Verifique se essa função index está escrita exatamente assim:
    public function index(Request $request)
    {
        $query = Product::with('country');

        if ($request->has('pais')) {
            $query->whereHas('country', function ($q) use ($request) {
                $q->where('name', $request->pais);
            });
        }

        $products = $query->get();

        return ProductResource::collection($products);
    }
}