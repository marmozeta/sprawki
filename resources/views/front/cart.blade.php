@extends('front.layouts.app')

@section('content')
@csrf
<div class="container-fluid pt-5">
    <div class="container">
        <section class="cart_view container mt-2 my-3 py-5">
            <div class="row mt-2">
                <h1 class="element_title">Koszyk</h1>
                <div class="divide"><i class="fa-solid fa-shopping-cart"></i></div>
            </div>
            
            @if(Cart::count() > 0)
            <div class="row">
                <div class="col-8 bg-white" id="products">
                    <div class="container-fluid mt-5">
                        @foreach(Cart::content() as $row)
                        <div class="row">
                            <div class="col-3 d-flex align-items-center">
                                <a class="remove_product mx-3" href="#" data-row-id="{{$row->rowId}}"><i class="fa-solid fa-remove"></i></a>                         
                                @if($row->options->has('image'))
                                    <img src="{{ asset('images/elements/'.$row->options->image) }}" class="img-thumbnail img-fluid" />
                                @endif
                            </div>
                            <div class="col-5 d-flex align-items-center">
                                <h4 class="product_title">{{ $row->name }}</h4>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <span class="qty">Ilość: </span><input type="text" name="quantity" value="{{ $row->qty }}" style="width: 30px; height: 20px;" />
                                <a class="update_quantity mx-3" href="#" data-row-id="{{$row->rowId}}"><i class="fa-solid fa-arrows-rotate"></i></a>
                            </div>
                            <div class="col-2 d-flex flex-wrap align-self-center"><span class="w-100 price">{{ $row->total }} zł</span><small class="w-100">{{ $row->price+$row->tax }} zł / szt.</small></div>
                            <div class="col-12 my-3">
                            <hr/>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4 bg-danger text-white px-5 py-5">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="subtitle">Podsumowanie</h3>
                        </div>
                    </div>
                    <div class="row d-flex">
   			<div class="col-7">Produkty</div>
   			<div class="col-5 text-right" id="subtotal"><?php echo Cart::subtotal(); ?> zł</div>
                        <div class="col-12"><hr/></div>
                    </div>
                    <div class="row">
   			<div class="col-7">Podatek VAT</div>
   			<div class="col-5 text-right" id="tax"><?php echo Cart::tax(); ?> zł</div>
                        <div class="col-12"><hr/></div>
                    </div>
                    <div class="row" style="font-size: 20px; color: #333; font-weight: bold;">
   			<div class="col-7">Do zapłaty (z VAT)</div>
   			<div class="col-5 text-right" id="total"><?php echo Cart::total(); ?> zł</div>
                    </div>
                        <div class="row">
                    <a href="{{ route('front.checkout') }}" id="checkout_button" class="btn btn-outline-dark bg-white mt-5">Przejdź do płatności</a>
                    </div></div>
                </div>
            </div>
             @else
             Nie masz jeszcze nic w koszyku!
             @endif
        </section>

    </div></div>
@endsection