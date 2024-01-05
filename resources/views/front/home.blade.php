@extends('front.layouts.app')

@section('content')
<div class="container-fluid" id="filter-bar">
    <div class="container filters">

    <ul class="filter option-set exclusive" data-filter-group="status">
      <li><span>Przestrzeń</span></li>
      <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
      @foreach($tags_space as $tag)
        &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
      @endforeach
    </ul>

      
    <ul class="filter option-set" data-filter-group="fandom">
      <li><span>Region geograficzny</span></li>
      <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
      @foreach($tags_region as $tag)
       &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
      @endforeach
    </ul>
       
    <ul class="filter option-set combine" data-filter-group="content">
      <li><span>Tagi</span></li>
      <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
      @foreach($tags_tags as $tag)
       &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
      @endforeach
    </ul>
     
        <div>
        <button class="btn btn-primary btn-sm filter-button text-bold">Filtrowanie zaawansowane <i class="fa fa-filter"></i></button>
        </div>
  </div>
</div>
		<div class="container">

			<div class="row">

        <div id="fh5co-board" class="grid">
            @foreach($elements as $element) 
        	<div class="item {{ $element->tags }}">
        		<div class="animate-box">
                                @if($menu->is_social)
                                    <span class="icon-corner"><i class="fa-solid fa-quote-right"></i></span>
                                    <span class="user-name">@marmozeta &nbsp;&#9679;&nbsp; @if(!empty($element->created_at) && $element->created_at!='0000-00-00 00:00:00') {{ Carbon\Carbon::parse($element->created_at) }} @endif
                       </span>
                                @endif
	        		<!--<a href="{{ asset('images/elements/'.$element->image) }}" class="image-popup fh5co-board-img" title="{{ $element->title }}">-->
                                    @if(!empty($element->image))
                                    <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}">
                                    @else
                                    <div class="caffle" style="height: 200px;">
                                      @if($menu->is_social) 
                                        {{ $element->title }}<br/>
                                        @endif
                                        {{ substr(strip_tags($element->description), 0, 200) }}@if(count($element->description>200)) ... @endif</div>
                                    @endif
                                    <!--<span class="icon-corner"><i class="fa fa-video" style="color: #fff;"></i></span>-->
                                    
                                    
                                    <!--</a>-->
        		</div>
        		<div class="fh5co-desc">
                            @if(!$menu->is_social) {{ $element->title }} @endif
                            <div class='icons'>
                                <span><i class="fa-regular fa-heart"></i> 34</span>
                                <span><i class="fa-regular fa-comments"></i> 2</span>
                            </div>
                       
                        
                       
                        </div>
        	</div>
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