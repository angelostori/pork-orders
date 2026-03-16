@extends('layouts.app')

@section('title', 'Modifica un nuovo cliente')

@section('content')
<div class="container py-4">
    <div class="p-4 rounded bg-light shadow-sm">
        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3 row align-items-center">
                <label for="name" class="fw-bold col-1 col-form-label">Nome</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Nome"
                        value="{{ $client->name }}">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="surname" class="fw-bold col-1 col-form-label">Cognome</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg"
                        type="text"
                        name="surname"
                        id="surname"
                        placeholder="Cognome"
                        value="{{ $client->surname }}">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="email" class="fw-bold col-1 col-form-label">Email</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg"
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="{{ $client->email }}">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="phone" class="fw-bold col-1 col-form-label">Telefono</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg"
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="Telefono"
                        value="{{ $client->phone }}">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="address" class="fw-bold col-1 col-form-label">Indirizzo</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg"
                        type="text"
                        name="address"
                        id="address"
                        placeholder="Indirizzo"
                        value="{{ $client->address }}">
                </div>
            </div>

            <button type="submit" class="btn btn-dark">Salva</button>

        </form>
    </div>
</div>
@endsection