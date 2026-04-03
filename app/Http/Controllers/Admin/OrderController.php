<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('client')
            ->orderBy('id', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();

        return view('orders.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*' => 'nullable|integer|min:0',
        ]);

        $hasProducts = false;

        foreach ($request->products as $quantity) {
            if ($quantity > 0) {
                $hasProducts = true;
                break;
            }
        }

        if (!$hasProducts) {
            return back()
                ->withErrors(['products' => 'Devi inserire almeno un prodotto'])
                ->withInput();
        }

        $clients = Client::all();
        $products = Product::all();

        $order = new Order();

        $order->client_id = $request->client_id;
        $order->order_date = now();
        $order->note = $request->note;
        $order->total = 0;

        $order->save();

        $total = 0;

        foreach ($request->products as $productId => $quantity) {

            if ($quantity > 0) {

                $product = Product::find($productId);

                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                $total += $product->price * $quantity;
            }
        }

        $order->total = $total;
        $order->save();

        return redirect()->route('orders.index', compact('clients', 'products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('client', 'products');

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*' => 'nullable|integer|min:0',
        ]);

        // controllo almeno un prodotto
        $hasProducts = false;

        foreach ($request->products as $quantity) {
            if ($quantity > 0) {
                $hasProducts = true;
                break;
            }
        }

        if (!$hasProducts) {
            return back()
                ->withErrors(['products' => 'Devi inserire almeno un prodotto'])
                ->withInput();
        }

        // aggiorna cliente
        $order->client_id = $request->client_id;

        // carica tutti i prodotti in una query
        $products = Product::whereIn('id', array_keys($request->products))
            ->get()
            ->keyBy('id');

        $attachData = [];
        $total = 0;

        foreach ($request->products as $productId => $quantity) {

            if ($quantity > 0) {

                $product = $products[$productId];

                $attachData[$productId] = [
                    'quantity' => $quantity,
                    'price' => $product->price
                ];

                $total += $product->price * $quantity;
            }
        }

        // sincronizza tutto
        $order->products()->sync($attachData);

        $order->total = $total;
        $order->save();

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
