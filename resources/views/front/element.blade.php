@extends('front.layouts.app')

@section('content')
    @if($menu->is_shop)
        @include('front.elements.shop') 
    @else
         @include('front.elements.default') 
    @endif
@endsection