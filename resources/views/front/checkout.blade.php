@extends('front.layouts.app')

@section('content')
<div class="container-fluid pt-5">
    <div class="container">
        <form id="checkout_process" action="{{ route('front.process') }}" method="POST">
        <section class="checkout_view container mt-2 my-3 py-5">
            <div class="row mt-2">
                <h1 class="element_title">Kasa</h1>
                <div class="divide"><i class="fa-solid fa-cash-register"></i></div>
            </div>
            
            <div class="row">
                <div class="col-6">
                    <div class="container-fluid">
                    <div class="row bg-danger p-5">
                        <div class="col-12">
                            <h3 class="subtitle">Dane zamawiającego</h3>
                            @if(!Auth::check())
                            <span class="text-white pb-3 d-block" style="font-family: Oswald;">Jeżeli masz już konto, <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-white" id="register_button">kliknij, aby się <span style='text-decoration: underline;'>zalogować</span></a>. Jeśli nie, wypełnij dane poniżej, żeby założyć konto i zamówić.</span>
                            @else
                            
                            @endif
                               @csrf
                                <input type="email" name="email" placeholder="Adres e-mail *" class="form-control bg-white border-0 required my-3" required value="{{ Auth::user() ? Auth::user()->email : '' }}" />
                                <input type="text" name="firstname" placeholder="Imię *" class="form-control bg-white border-0 required my-3" required value="{{ $firstname }}" />
                                <input type="text" name="lastname" placeholder="Nazwisko *" class="form-control bg-white border-0 required my-3" required value="{{ $lastname }}" />
                                @if(!Auth::check())
                                <input type="password" id="password" name="password" placeholder="Hasło *" class="form-control bg-white border-0 required my-3" required />
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Powtórz hasło *" class="form-control bg-white border-0 required my-3" required />
                                @endif
                                <textarea name="comments" placeholder="Uwagi do zamówienia" class="form-control bg-white border-0 my-3"></textarea>
                               <small class="text-white d-block py-3">Drogi Sprawkowiczu, administratorem danych jest Dawid Mysior, ul. Sobieskiego 21 81-761 Sopot, NIP:  527-231-24-72. Przetwarzamy Wasze dane osobowe w celu umożliwienia korzystania z funkcji naszej strony internetowej, w tym udziału w życiu Społeczności Sprawek, dokonywania zakupów w naszym sklepie internetowym, a także do pozostałych celów wskazanych w naszej polityce prywatności.</small>
                             
                        </div>
                        <div class="col-12 mt-5">
                            <h3 class="subtitle">Metoda płatności</h3>
                                @csrf
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                  <label class="form-check-label text-white" for="flexRadioDefault2">
                                    Płacę z Tpay
                                  </label>
                                </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-6 bg-white p-5" id="products">
                    <div class="container-fluid">
                        @foreach(Cart::content() as $row)
                        <div class="row">
                            <div class="col-3 d-flex align-items-center">
                                @if($row->options->has('image'))
                                    <img src="{{ asset('images/elements/'.$row->options->image) }}" class="img-thumbnail img-fluid" />
                                @endif
                            </div>
                            <div class="col-5 d-flex align-items-center">
                                <h4 class="product_title">{{ $row->name }}</h4>
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <span class="qty">Ilość: </span>{{ $row->qty }}
                                 </div>
                            <div class="col-2 d-flex flex-wrap align-self-center"><span class="w-100 price">{{ $row->total }} zł</span></div>
                            <div class="col-12 my-3">
                            <hr/>
                            </div>
                        </div>
                        @endforeach
                    </div>
               
                    <div class="container-fluid">
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
                    <div class="row" style="font-weight: bold; color: #333; font-size: 20px;">
   			<div class="col-7">Do zapłaty (z VAT)</div>
   			<div class="col-5 text-right" id="total" style="color: #ef5353"><?php echo Cart::total(); ?> zł</div>
                    </div>
                        <div class="row pt-5 acceptances">
                            <div class="text-dark"><input type="checkbox" id="acceptance1" required /><label for="acceptance1"> <span class="text-danger">*</span> Akceptuję zasady określone w regulaminie.</label></div>
                            <div class="text-dark"><input type="checkbox" id="acceptance2" required /><label for="acceptance2">  <span class="text-danger">*</span> Wyrażam zgodę na udostępnienie plików przed 14-dniowym terminem na odstąpienie od umowy zawartej na odległość.</label></a>
                            <div class="text-dark"><input type="checkbox" id="acceptance3" required /><label for="acceptance3">  <span class="text-danger">*</span> Jestem świadomy, że stracę prawo do odstąpienia po dostarczeniu mi plików przed upływem 14 dni na odstąpienie od umowy zawartej na odległość.</label></a>
                            <div class="text-dark"><input type="checkbox" id="acceptance4" /><label for="acceptance4">  Chcę otrzymywać na podany adres e-mail informacje o nowościach, inicjatywach, promocjach i wydarzeniach. Wiem, że moją zgodę mogę odwołać w dowolnym momencie. Więcej informacji o przetwarzaniu moich danych osobowych.</label></a>
                            <br/><small class="d-block w-100 text-right">* Zgody wymagane</small>
                        </div>
                        <div class="row">
                    <button id="process_button" class="btn btn-primary text-white mt-5">Zamawiam i płacę</button>
                    </div>
                    </div>
                </div>
            </div>
        </section>
 </form>
    </div></div>
@endsection


@section('scripts')
<script>
        var password = document.getElementById("password")
      , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Hasła nie zgadzają się!");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endsection