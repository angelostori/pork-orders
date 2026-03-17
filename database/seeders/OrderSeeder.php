<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $products = Product::all();

        for ($i = 0; $i < 50; $i++) {

            $order = new Order();

            $order->client_id = $clients->random()->id;
            $order->order_date = now();
            $order->total = 0;

            $order->save();

            $total = 0;

            foreach ($products->random(5) as $product) {

                $quantity = rand(1, 5);

                // inserimento nella pivot
                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                $total += $product->price * $quantity;
            }

            // 👉 aggiorno il totale finale
            $order->total = $total;
            $order->save();
        }
    }
}
