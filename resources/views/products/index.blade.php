@extends('layouts.app')

@section('title', 'Lista Prodotti')

@section('content')

<div class="container">
    <table class="m-auto table table-primary">
        <thead>
            <tr class="table-dark">
                <th>Immagine</th>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Prezzo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="p-3">{{ $product->image ?? "-" }}</td>
                <td class="p-3">{{ $product->name }}</td>
                <td class="p-3">{{ $product->description }}</td>
                <td class="p-3">{{ $product->price . ' ' . "€\Kg" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection