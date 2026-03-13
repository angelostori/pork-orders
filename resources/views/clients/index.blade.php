@extends('layouts.app')

@section('title', 'Lista Clienti')

@section('content')

<div class="container">

    <table class="m-auto table table-light">
        <thead>
            <tr class="table-dark">
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Indirizzo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($clients as $client)
            <tr>
                <td class="p-3">{{ $client->name }}</td>
                <td class="p-3">{{ $client->surname }}</td>
                <td class="p-3">{{ $client->email }}</td>
                <td class="p-3">{{ $client->phone }}</td>
                <td class="p-3">{{ $client->address }}</td>
                <td><a class="btn btn-outline-warning" href="{{ route('clients.edit', $client) }}">Modifica</a></td>
                <td>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $client->id }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    <div class="modal fade" id="deleteModal-{{ $client->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Eliminare il cliente: {{ $client->name . ' ' . $client->surname }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vuoi veramente eliminare questo cliente? Questa azione è irreversibile.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST">
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