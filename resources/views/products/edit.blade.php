@extends('layouts.app')

@section('title', 'Modifica Prodotto')

@section('content')

<div class="container py-4">
    <div class="bg-light p-4 rounded shadow-sm">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row align-items-center">
                <label for="name" class="col-form-label fw-bold col-1">Nome</label>
                <div class="col-8">
                    <input
                        type="text"
                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ $product->name }}">
                    @error('name')
                    <span class="mt-2 text-danger">*Il campo Nome è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="price" class="col-form-label fw-bold col-1">Prezzo</label>
                <div class="col-6">
                    <input
                        type="text"
                        class="form-control form-control-lg @error('price') is-invalid @enderror"
                        id="price"
                        name="price"
                        value="{{ $product->price }}">
                    @error('price')
                    <span class="mt-2 text-danger">*Il campo Prezzo è obbligatorio</span>
                    @enderror
                </div>
                <label for="price" class="col-form-label fw-bold col-1">€\Kg</label>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="image" class="col-form-label fw-bold col-1">Immagine</label>
                <div class="col-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <span class="mt-2 text-danger">*Il formato dell'immagine non è valido</span>
                    @enderror
                </div>
                @if($product->image)
                <div class="col-4">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="copertina del progetto {{ $product->name }}"
                        class="img-fluid w-25">
                </div>
                @endif
            </div>

            <div class="mb-3 row align-items-center">
                <label for="description" class="col-form-label fw-bold col-1">Descrizione</label>
                <div class="col-8">
                    <textarea
                        class="form-control form-control-lg"
                        id="description"
                        name="description"
                        rows="6">{{ $product->description }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </form>
    </div>
</div>

@endsection