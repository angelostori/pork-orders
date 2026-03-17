@extends('layouts.app')

@section('title', 'Lista Ordini')

@section('content')

<div class="container"></div>
<h1>Lista Ordini</h1>
<table class="table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Prodotti</th>
            <th>Data Ordine</th>
            <th>Totale</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->client->name . ' ' . $order->client->surname }}</td>
            <td>
                <ul>
                    @foreach ($order->products as $product)
                    <li>{{ $product->name }} ({{ $product->pivot->quantity }} x {{ $product->pivot->price }})</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection