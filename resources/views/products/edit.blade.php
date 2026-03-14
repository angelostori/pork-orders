@extends('layouts.app')

@section('title', 'Modifica Prodotto')

@section('content')

<div class="container">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="name" class="col-form-label fw-bold col-1">Nome</label>
            <div class="col-8">
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="price" class="col-form-label fw-bold col-1">Prezzo</label>
            <div class="col-6">
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <label for="price" class="col-form-label fw-bold col-1">€\Kg</label>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-form-label fw-bold col-1">Descrizione</label>
            <div class="col-8">
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salva modifiche</button>
    </form>

</div>

@endsection