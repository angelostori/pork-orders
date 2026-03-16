@extends('layouts.app')

@section('title', 'Lista Prodotti')

@section('content')

<div class="container table-responsive">
    <table class="m-auto table table-primary mb-3 table-striped table-hover text-center">
        <thead>
            <tr class="table-dark text-uppercase fw-bold">
                <th>Immagine</th>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Prezzo</th>
                <th>Dettaglio</th>
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="p-3">
                    @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="copertina del progetto {{ $product->name }}"
                        class="img-fluid"
                        style="max-width: 100px; height: auto;">
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="p-3 align-content-center">{{ $product->name }}</td>
                <td class="p-3 align-content-center">{{Str::limit($product->description, 60)  }}</td>
                <td class="p-3 fw-bold align-content-center">{{ $product->price . ' ' . "€\Kg" }}</td>
                <td class="align-content-center"><a class=" btn btn-outline-primary" href="{{ route('products.show', $product) }}"><i class="bi bi-eye"></i></a></td>
                @auth
                <td class="align-content-center">
                    <a class="btn btn-warning text-light" href="{{ route('products.edit', $product) }}">
                        <i class="bi bi-pencil"></i>
                    </a>
                </td>
                <td class="align-content-center">
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    <div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Eliminare il prodotto: {{ $product->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vuoi veramente eliminare questo prodotto? Questa azione è irreversibile.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Conferma e Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection