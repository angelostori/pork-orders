@extends('layouts.app')

@section('title', 'Crea un nuovo cliente')

@section('content')

<div class="container">
    <div class="p-4 rounded bg-light shadow-sm row">
        <div class="col-11">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="mb-3 row align-items-center">
                    <label for="name" class="fw-bold col-1 col-form-label me-3">Nome</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Nome">
                        @error('name')
                        <span class="mt-2 text-danger">*Il campo Nome è obbligatorio</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="surname" class="fw-bold col-1 col-form-label me-3">Cognome</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg @error('surname') is-invalid @enderror" type="text" name="surname" id="surname" placeholder="Cognome">
                        @error('surname')
                        <span class="mt-2 text-danger">*Il campo Cognome è obbligatorio</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="email" class="fw-bold col-1 col-form-label me-3">Email</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email">
                        @error('email')
                        <span class="mt-2 text-danger">*Email già presente</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label for="phone" class="fw-bold col-1 col-form-label me-3">Telefono</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" placeholder="Telefono">
                        @error('phone')
                        <span class="mt-2 text-danger">*Numero massimo di caratteri superato (20)</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row align-items-center">

                    <label for="address" class="fw-bold col-1 col-form-label me-3">Indirizzo</label>

                    <div class="col-8">
                        <input class="form-control form-control-lg @error('address') is-invalid @enderror" type="text" name="address" id="address" placeholder="Indirizzo">
                        @error('address')
                        <span class="mt-2 text-danger">*Numero massimo di caratteri superato</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">
                    <span>Salva</span>
                    <i class="bi bi-save2"></i>
                </button>
            </form>
        </div>

        <div class="col-1">
            <img src="{{ asset('images/pork_orders_logo_vertical.svg') }}" class="create-form-img">
        </div>
    </div>
</div>

@endsection