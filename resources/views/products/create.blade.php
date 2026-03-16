@extends('layouts.app')

@section('title', 'Crea Prodotto')

@section('content')

<div class="container">
    <div class="p-4 rounded bg-light shadow-sm">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row align-items-center">
                <label for="name" class="form-label col-1 fw-bold col-form-label">Nome</label>
                <div class="col-8">
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                </div>
            </div>
            <div class="mb-3 row align-items-center">
                <label for="price" class="form-label col-1 fw-bold col-form-label">Prezzo</label>
                <div class="col-6">
                    <input type="number" class="form-control form-control-lg" id="price" name="price" step="0.01" required>
                </div>
                <label for="price" class="form-label col-1 fw-bold col-form-label">€\Kg</label>
            </div>
            <div class="mb-3 row align-items-center">
                <label for="image" class="form-label col-1 fw-bold col-form-label">Immagine</label>
                <div class="col-8">
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <div class="mb-3 row align-items-center">
                <label for="description" class="form-label col-1 fw-bold col-form-label">Descrizione</label>
                <div class="col-8">
                    <textarea class="form-control form-control-lg" id="description" name="description" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <span>Salva</span>
                <i class="bi bi-save2"></i>
            </button>
        </form>
    </div>
</div>

@endsection