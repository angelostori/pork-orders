@extends('layouts.app')

@section('title', 'Crea un nuovo ordine')

@section('content')

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <select name="client_id">
        @foreach($clients as $client)
        <option value="{{ $client->id }}">
            {{ $client->name }} {{ $client->surname }}
        </option>
        @endforeach
    </select>

    <h3>Prodotti</h3>

    @foreach($products as $product)

    <div>
        <span>{{ $product->name }} ({{ $product->price }} €)</span>

        <input type="number" name="products[{{ $product->id }}]" value="0" min="0">
    </div>

    @endforeach

    <button type="submit">Crea ordine</button>

</form>

@endsection