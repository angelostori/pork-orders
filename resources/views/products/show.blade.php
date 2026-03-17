@extends('layouts.app')

@section('title', 'Dettagli Prodotto')

@section('content')

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h3>{{ $product->name }}</h3>
        </div>
        <div class="card-body p-4">
            @if($product->image)
            <div class="card-image text-center">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="copertina del progetto {{ $product->name }}"
                    class="img-fluid rounded mb-3"
                    style="max-height: 400px; object-fit: cover; width: 90%;">
            </div>
            @endif
            <h4 class="card-title">Prezzo: {{ $product->price . ' ' . '€\Kg' }}</h4>
            <p class="card-text">{{ $product->description }}</p>
        </div>
        <div class="card-footer py-3 d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('products.index') }}">Torna alla lista dei prodotti</a>
        </div>
    </div>
</div>

@endsection