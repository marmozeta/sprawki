@extends('front.layouts.app')

@section('content')
<div class="container-fluid pt-5">
    <div class="container">
        <section class="cart_view thank_you container mt-2 my-3 py-5">
            <div class="row mt-2 text-center">
                <h1 class="element_title">Zamówienie #{{ $order->id}}</h1>
                <div class="divide" style="width: 200px; margin: 35px auto 25px auto;"><i class="fa-solid fa-handshake" style="margin-left: 130px;"></i>&nbsp;</div>
                <p class="text-dark">Dziękujemy za złożenie zamówienia.</p>
                <div class="w-100 text-center">
                    <a href="{{ route('order.get_files_by_order', $order->id) }}" class="btn btn-success btn-sm text-bold mx-2 download-button" style="width: auto;">Pobierz <i class="fa-solid fa-download"></i></a>
                </div>
                <p class="text-dark">W razie pytań skontaktuj się z nami, podając numer zamówienia.</p>
            
            </div>
        </section>
    </div>
</div>
@endsection

