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
                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Nome"
                        value="{{ $client->name }}">
                    @error('name')
                    <span class="mt-2 text-danger">*Il campo Nome è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="surname" class="fw-bold col-1 col-form-label">Cognome</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg @error('surname') is-invalid @enderror"
                        type="text"
                        name="surname"
                        id="surname"
                        placeholder="Cognome"
                        value="{{ $client->surname }}">
                    @error('surname')
                    <span class="mt-2 text-danger">*Il campo Cognome è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="email" class="fw-bold col-1 col-form-label">Email</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="{{ $client->email }}">
                    @error('email')
                    <span class="mt-2 text-danger">*Il campo Email è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="phone" class="fw-bold col-1 col-form-label">Telefono</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="Telefono"
                        value="{{ $client->phone }}">
                    @error('phone')
                    <span class="mt-2 text-danger">*Il campo Telefono è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="address" class="fw-bold col-1 col-form-label">Indirizzo</label>
                <div class="col-8">
                    <input
                        class="form-control form-control-lg @error('address') is-invalid @enderror"
                        type="text"
                        name="address"
                        id="address"
                        placeholder="Indirizzo"
                        value="{{ $client->address }}">
                    @error('address')
                    <span class="mt-2 text-danger">*Il campo Indirizzo è obbligatorio</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-dark">Salva</button>

        </form>
    </div>
</div>
@endsection