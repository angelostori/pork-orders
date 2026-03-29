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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'products' => 'required|array',
            'note ' => ' nullable | string ',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $order = new Order();
        $order->client_id = $client->id;
        $order->order_date = now();
        $order->total = 0;
        $order->note = $request->note;
        $order->save();

        $total = 0;

        foreach ($request->products as $productId => $quantity) {

            if ($quantity > 0) {

                $product = Product::find($productId);

                if (!$product) {
                    continue;
                }

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
            'message' => 'Ordine creato',
            'order' => $order
        ]);
    }
}
