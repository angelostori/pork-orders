<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->save();

        if (array_key_exists('image', $data)) {
            $imagePath = Storage::putFile("products", $data['image']);
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('products.show', $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];

        if (array_key_exists('image', $data)) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $imagePath = Storage::putFile("products", $data['image']);
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
