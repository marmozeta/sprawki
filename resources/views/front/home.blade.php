@extends('front.layouts.app')

@section('content')
    @include('front.layouts.partials.filters')  
    
		<div class="container">

        <div id="fh5co-board" class="row">
            @csrf
            @foreach($elements as $element) 
                @if($menu->is_shop)
                    @include('front.elements.loop.shop') 
                @else
                    @include('front.elements.loop.default') 
                @endif
            @endforeach
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