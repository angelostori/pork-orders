@extends('layouts.app')

@section('title', 'Dettagli Cliente')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">
                <i class="bi bi-person me-2 text-primary"></i>Cliente
            </h5>
            <p><strong>Nome:</strong> {{ $client->name }}</p>
            <p><strong>Cognome:</strong> {{ $client->surname }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>
            <p><strong>Telefono:</strong> {{ $client->phone }}</p>
            <p><strong>Indirizzo:</strong> {{ $client->address }}</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">
                <i class="bi bi-bag me-2 text-primary"></i>Ordini del cliente
            </h5>

            @if($client->orders->isEmpty())
            <p>Il cliente non ha ancora effettuato ordini.</p>
            @else
            <ul>
                @foreach($client->orders as $order)
                <li>
                    <span>Ordine #{{ $order->id }} - {{ $order->order_date }} - Totale: {{ $order->total }} €</span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Torna alla lista clienti
        </a>
    </div>
    @endsection