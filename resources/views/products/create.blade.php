@extends('layouts.app')

@section('title', 'Crea Prodotto')

@section('content')

<div class="container">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crea Prodotto</button>
    </form>
</div>

@endsection