@extends('front.layouts.app')

@section('content')
    @include('front.layouts.partials.filters')  
    
		<div class="container">

                    <div id="fh5co-board"><div class="row @if(!$menu->is_shop) iso-grid @endif">
            @csrf
            @foreach($elements as $key=>$element) 
                @if($menu->is_shop)
                    @include('front.elements.loop.shop') 
                @else
                    @include('front.elements.loop.default') 
                @endif
                
                @if(!empty($ad_element)) && ($key+1)%4==0) 
                    @include('front.elements.loop.ad') 
                @endif
            @endforeach
        </div>
       </div>
	 </div>
@endsection

<!--
date
image
in_sale
is_hot
is_new
price
title
-->