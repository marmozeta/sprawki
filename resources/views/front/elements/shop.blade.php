<div class="shop container">
    <div class="row mt-5">
        <div class="col-12">
            <h1 class="element_title mt-4 pt-5">{{ $element->title }}</h1>
        </div>
        @if(!empty($element->image))
        <div class="col-7 image my-4">
            <img class="img-fluid rounded" src="{{ asset('images/elements/'.$element->image) }}" />
        </div>
        @endif
        <div class="@if(!empty($element->image)) col-4 offset-1 @else col-12 @endif">
            @if(!$product_categories->isEmpty())
                 <h5 class="categories">Kategoria:&nbsp; 
                   @foreach($product_categories as $pcat)
                        <a href="">{{ $pcat->name }}</a>
                    @endforeach
                </h5>
            @endif
            @if(!$product_tags->isEmpty())
                <h5 class="categories">Tagi:&nbsp; 
                        @foreach($product_tags as $ptag)
                            <a href="">{{ $ptag->name }}</a>
                        @endforeach
                </h5> 
            @endif
            <div class="divide"><i class="fa-solid fa-store"></i></div>
            <h3 class="price">Cena: {{ number_format($element->price, 2, ',', ' ') }} zł</h3>
            <div class="row mt-5">
                @if(!$element->is_virtual)
            <div class="col-4" style="margin-left: 12px;">
            <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="99999">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
            </div></div>
                @else
                <input type="hidden" name="quantity" value="1" />
                @endif
            <div class="col-6" @if($element->is_virtual) style="margin-left: 12px;" @endif>
                @if($is_bought)
                    <a href="{{ route('order.get_files', $element->element_id) }}" class="btn btn-success btn-sm filter-button download-button text-bold" data-element-id="{{ $element->element_id }}">Pobierz <i class="fa-solid fa-download"></i></a>
                @elseif($is_in_cart)
                    <a href="{{ route('front.cart') }}" class="btn btn-primary btn-sm go_to_cart text-bold my-0">Przejdź do koszyka <i class="fa-solid fa-cart-shopping"></i></a>
                @else
                    @csrf
                    <button class="btn btn-primary btn-sm filter-button text-bold add_to_cart" data-element-id="{{ $element->element_id }}">Dodaj do koszyka <i class="fa-solid fa-cart-shopping"></i></button>
                @endif
                <a href="{{ route('front.cart') }}" class="btn btn-primary btn-sm go_to_cart text-bold my-0 d-none">Przejdź do koszyka <i class="fa-solid fa-cart-shopping"></i></a>
                <a href="/sklep" class="btn btn-dark btn-sm filter-button text-bold back_to_shop my-2 @if(!$is_bought && !$is_in_cart) d-none @endif">Powróć do sklepu &nbsp;<i class="fa-solid fa-rotate-left"></i></a>
            </div></div></div>
        
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            {!! $element->description !!}
        </div>
    </div>
</div>