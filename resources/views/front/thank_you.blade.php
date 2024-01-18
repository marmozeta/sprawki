@extends('front.layouts.app')

@section('content')
<div class="container-fluid pt-5">
    <div class="container">
        <section class="cart_view container mt-2 my-3 py-5">
            <div class="row mt-2">
                <h1 class="element_title">Zamówienie #{{ $order->id}}</h1>
                <div class="divide"><i class="fa-solid fa-handshake"></i>&nbsp;</div>
                <p class="text-dark">Dziękujemy za złożenie zamówienia. Twoje produkty zostaną do Ciebie wysłane natychmiast po zaksięgowaniu wpłaty!</p>
                <p class="text-dark">W razie pytań skontaktuj się z nami, podając numer zamówienia.</p>
            
            </div>
        </section>
    </div>
</div>
@endsection