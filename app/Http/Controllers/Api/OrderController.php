<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'products'])->get();

        return response()->json($orders);
    }

    public function show(Order $order)
    {
        $order->load(['client', 'products']);

        return response()->json($order);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'products' => 'required|array',
            'note' => 'nullable|string',
        ]);

        $email = isset($data['email']) ? strtolower(trim($data['email'])) : null;

        $client = Client::firstOrCreate(
            ['email' => $email],
            [
                'name' => $data['name'],
                'surname' => $data['surname'],
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
            ]
        );

        $order = new Order();
        $order->client_id = $client->id;
        $order->order_date = now();
        $order->total = 0;
        $order->note = $data['note'] ?? null;
        $order->save();

        $total = 0;

        $products = Product::whereIn('id', array_keys($data['products']))
            ->get()
            ->keyBy('id');

        foreach ($data['products'] as $productId => $quantity) {

            if ($quantity > 0 && isset($products[$productId])) {

                $product = $products[$productId];

                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                $total += $product->price * $quantity;
            }
        }

        $order->total = $total;
        $order->save();

        return response()->json([
            'message' => 'Ordine creato con successo',
            'order' => $order->load('client', 'products')
        ]);
    }
}
