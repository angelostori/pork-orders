@extends('layouts.app')

@section('title', 'Crea un nuovo cliente')

@section('content')

<div class="container">
    <div class="p-4 rounded bg-light shadow-sm">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="mb-3 row align-items-center">
                <label for="name" class="fw-bold col-1 col-form-label">Nome</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="name" id="name" placeholder="Nome">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="surname" class="fw-bold col-1 col-form-label">Cognome</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="surname" id="surname" placeholder="Cognome">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="email" class="fw-bold col-1 col-form-label">Email</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Email">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="phone" class="fw-bold col-1 col-form-label">Telefono</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="phone" id="phone" placeholder="Telefono">
                </div>
            </div>

            <div class="mb-3 row align-items-center">
                <label for="address" class="fw-bold col-1 col-form-label">Indirizzo</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="address" id="address" placeholder="Indirizzo">
                </div>
            </div>

            <button type="submit" class="btn btn-dark">
                <span>Salva</span>
                <i class="bi bi-save2"></i>
            </button>

        </form>
    </div>
</div>

@endsection