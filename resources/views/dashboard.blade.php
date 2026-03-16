@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">

                        {{ session('status') }}
                    </div>
                    @endif

                    <a href="{{ route('clients.index') }}" class="btn btn-dark">Lista clienti</a>
                    <a href="{{ route('clients.create') }}" class="btn btn-dark">Aggiungi cliente</a>

                    <a href="{{ route('products.index') }}" class="btn btn-primary">Lista prodotti</a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Aggiungi prodotto</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection