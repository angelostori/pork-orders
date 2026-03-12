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
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection