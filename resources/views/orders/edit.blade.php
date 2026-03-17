@extends('layouts.app')

@section('title', 'Modifica Ordine')

@section('content')

<form action="{{ route('orders.update', $order) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="client_id">
        @foreach($clients as $client)
        <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
            {{ $client->name }} {{ $client->surname }}
        </option>
        @endforeach
    </select>

    <h3>Prodotti</h3>

    @foreach($products as $product)

    <div>
        <span>{{ $product->name }} ({{ $product->price }} €)</span>

        <input type="number" name="products[{{ $product->id }}]" value="{{ $order->products->find($product->id)->pivot->quantity ?? 0 }}" min="0">
    </div>

    @endforeach

    <button type="submit">Aggiorna ordine</button>

</form>

@endsection