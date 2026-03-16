@extends('layouts.app')

@section('title', 'Dettagli Prodotto')

@section('content')

<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h3>{{ $product->name }}</h3>

        </div>
        <div class="card-body">
            @if($product->image)
            <div class="card-image">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="copertina del progetto {{ $product->name }}"
                    class="img-fluid pb-3"
                    style="display: block; margin-left: auto; margin-right: auto; max-width: 400px; height: auto;">
            </div>
            @endif
            <h4 class="card-title">Prezzo: {{ $product->price . ' ' . '€\Kg' }}</h4>
            <p class="card-text">{{ $product->description }}</p>
        </div>
        <a class="btn btn-primary" href="{{ route('products.index') }}">Torna alla lista dei prodotti</a>
    </div>
</div>

@endsection