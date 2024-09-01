@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 bg-light rounded-3">
    <div class="container py-5">
        <h1 class="fw-bold">Travel App</h1>
        <p class="fs-4">
            Benvenuto su Travel App, il tuo compagno di viaggio definitivo. Registra ogni tua avventura, dai viaggi in città ai viaggi intorno al mondo. Condividi le tue esperienze, scopri nuove destinazioni e crea ricordi indimenticabili.
        </p>
        <p class="fs-5">Inizia oggi il tuo viaggio con noi!</p>
        <div class="">

            <a class="btn" href="{{route('register')}}">Registrati</a>
            <span>o</span>
            <a class="btn" href="{{route('login')}}">Accedi</a>

        </div>
    </div>
</div>

<div class="py-5">
    <div class="container_custom">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Registra ogni momento speciale</h3>
                <p class="fs-5">
                    Ogni viaggio è unico, e qui puoi rivivere ogni momento speciale.
                    Non importa se è un weekend fuori porta o un viaggio intorno al mondo,
                    questa è la tua storia di viaggio.
                </p>
            </div>
            <div class="">
                <img class="w-100 h-100" src="{{asset('image/assets/airplane.bmp')}}" alt="">
            </div>
        </div>

    </div>

</div>

<div class="py-5 bg-light">
    <div class="container_custom fs-5">
        <ul class="d-flex justify-content-between text-center">
            <li>
                <p>
                    Tieni traccia di tutti i tuoi viaggi
                </p>
                <i class="fa-solid fa-compass fs-3"></i>
            </li>
            <li>
                <p>
                    Aggiungi foto e curiosità
                </p>
                <i class="fa-solid fa-images fs-3"></i>
            </li>
            <li>
                <p>
                    Conserva i ricordi delle tue avventure
                </p>
                <i class="fa-solid fa-box-archive fs-3"></i>
            </li>
        </ul>
    </div>

</div>


@endsection
