@extends('layouts.app')

@section('title', 'Modifica Ordine')

@section('content')
<div class="container mb-5">

    @error('products')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror

    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Card Cliente --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-person me-2 text-primary"></i>Cliente
                </h5>
                <select name="client_id" class="form-select form-select-lg">
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
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
                                value="{{ $order->products->find($product->id)?->pivot->quantity ?? 0 }}"
                                min="0"
                                class="form-control text-center"
                                style="width: 90px;">
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i>Salva modifiche
            </button>
        </div>

    </form>
</div>

@endsection