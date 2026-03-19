@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <div class="">
            <svg id="welcome-img" width="100%" viewBox="0 0 680 160" xmlns="http://www.w3.org/2000/svg">
                <circle cx="72" cy="80" r="44" fill="none" stroke="#e8809a" stroke-width="3" />
                <ellipse cx="52" cy="44" rx="10" ry="13" fill="none" stroke="#e8809a" stroke-width="3" transform="rotate(-15 52 44)" />
                <ellipse cx="92" cy="44" rx="10" ry="13" fill="none" stroke="#e8809a" stroke-width="3" transform="rotate(15 92 44)" />
                <circle cx="60" cy="70" r="3.5" fill="#e8809a" />
                <circle cx="84" cy="70" r="3.5" fill="#e8809a" />
                <ellipse cx="72" cy="92" rx="14" ry="10" fill="none" stroke="#e8809a" stroke-width="2.5" />
                <circle cx="67" cy="92" r="3" fill="#e8809a" />
                <circle cx="77" cy="92" r="3" fill="#e8809a" />
                <line x1="148" y1="28" x2="148" y2="132" stroke="#008c8c" stroke-width="1.5" />
                <text x="172" y="80" class="lt" dominant-baseline="middle">pork<tspan class="ls">orders</tspan></text>
            </svg>
        </div>

        <p class="col-md-8 fs-4">
            Ciao! Pork Orders è il tuo assistente per gestire clienti, prodotti e ordini senza stress. Inizia subito: aggiungi i tuoi clienti, configura il catalogo e tieni tutto sotto controllo con pochi click.
        </p>
    </div>
</div>

<div class="content">
    <div class="container d-flex">
        <p class="mt-1 me-3">Accedi alla tua <a class="" href="/dashboard">Dashboard</a> per iniziare a gestire il flusso di lavoro quotidiano.</p>

    </div>
</div>
@endsection