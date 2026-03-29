@extends('layouts.app')

@section('title', 'Crea un nuovo ordine')

@section('content')
<div class="container mb-5">

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-person me-2 text-primary"></i>Cliente
                </h5>
                <select name="client_id" class="form-select form-select-lg">
                    <option value="" disabled selected>Seleziona un cliente...</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->name }} {{ $client->surname }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="mb-3">
                    <i class="bi bi-box-seam me-2 text-primary"></i>Prodotti
                </h5>

                <div class="d-flex flex-column gap-3">
                    @foreach($products as $product)
                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light">

                        <div>
                            <span class="fw-medium">{{ $product->name }}</span>
                            <span class="badge bg-success ms-2">{{ $product->price }} €/Kg</span>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <label class="text-muted small me-1">Quantità</label>
                            <input
                                type="number"
                                name="products[{{ $product->id }}]"
                                value="0"
                                min="0"
                                class="form-control text-center"
                                style="width: 90px;">
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-journal-text me-2 text-primary"></i>Note
                </h5>
                <textarea name="note" class="form-select form-select-lg" placeholder="Note (facoltativo)">
                </textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i>Crea ordine
            </button>
        </div>

    </form>
</div>

@endsection