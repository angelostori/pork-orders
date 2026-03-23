<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {

            $product->image = $product->image ? asset('storage/' . $product->image) : null;

            return $product;
        });

        return response()->json($products);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }
}
