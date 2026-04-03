@extends('layouts.app')

@section('title', 'Lista Ordini')

@section('content')

<div class="container table-responsive">

    <table id="table-orders" class="table m-auto table-striped table-hover align-middle mb-3">
        <thead>
            <tr class="table-dark text-uppercase fw-bold">
                <th>ID</th>
                <th>Data Ordine</th>
                <th>Cliente</th>
                <th>Prodotti</th>
                <th>Note</th>
                <th>Totale</th>
                <th>Azioni</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="p-3 fw-bold">{{ $order->id }}</td>
                <td class="p-3 fw-bold">{{ $order->order_date }}</td>
                <td class="p-3">{{ $order->client->name . ' ' . $order->client->surname }}</td>
                <td class="p-3">
                    <ul>
                        @foreach ($order->products as $product)
                        <li>{{ $product->name }} ({{ $product->pivot->quantity }} x {{ $product->pivot->price . ' €'}})</li>
                        @endforeach
                    </ul>
                </td>
                <td class="p-3">
                    <p>{{ $order->note ?? 'Nessuna nota' }}</p>
                </td>
                <td class="p-3">{{ $order->total . ' €' }}</td>
                <td class="p-3">

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>

                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning text-light">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->id }}">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                    </div>

                    <div class="modal fade" id="deleteModal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Eliminare l'ordine: {{ $order->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vuoi veramente eliminare questo ordine? Questa azione è irreversibile.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Conferma e Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection