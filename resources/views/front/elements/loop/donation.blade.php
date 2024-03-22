 <form method="post" action="{{ route('front.donate') }}">
<div class="d-flex mx-5 justify-content-center pb-5 flex-wrap" style="column-gap: 10px;">
   
        @csrf
        <input type="email" name="email" placeholder="Adres e-mail *" class="form-control bg-white border-0 required my-3" required value="{{ Auth::user() ? Auth::user()->email : '' }}" />
        <input type="text" name="firstname" placeholder="Imię *" class="form-control bg-white border-0 required my-3" required value="{{ $firstname }}" />
        <input type="text" name="lastname" placeholder="Nazwisko *" class="form-control bg-white border-0 required my-3" required value="{{ $lastname }}" />
                                
        <input type="number" name="amount" class="form-control bg-white border-0 required my-3" step="0.01" placeholder="Podaj kwotę darowizny (zł)" />
        <button class="btn btn-primary btn-sm filter-button text-bold back_to_shop w-100 my-3 py-4">Zapłać z Tpay</button>
    

</div></form>