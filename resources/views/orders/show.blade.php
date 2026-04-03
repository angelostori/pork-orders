@extends('layouts.app')

@section('title', 'Dettagli Ordine')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">
                <i class="bi bi-bag me-2 text-primary"></i>Ordine #{{ $order->id }}
            </h5>
            <p><strong>Data Ordine:</strong> {{ $order->order_date }}</p>
            <p><strong>Prodotti:</strong></p>
            <ul class="list-unstyled">
                @foreach ($order->products as $product)
                <li>
                    <strong>{{ $product->name }}</strong> - Quantità: {{ $product->pivot->quantity }} - Prezzo: {{ $product->pivot->price }} €
                </li>
                @endforeach
            </ul>
            <p><strong>Nota:</strong> {{ $order->note ?? 'Nessuna nota' }}</p>
            <p><strong>Totale:</strong> {{ $order->total }} €</p>
            <p><strong>Cliente:</strong> <a href="{{ route('clients.show', $order->client->id) }}">{{ $order->client->name }} {{ $order->client->surname }}</a></p>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Torna alla lista ordini
        </a>
    </div>
    @endsection