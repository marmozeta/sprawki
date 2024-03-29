<div class="col-3 my-3 {{ $element->tags }}">
    <div class="item shop">
        		<a href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}" class="animate-box">
	        		<!--<a href="{{ asset('images/elements/'.$element->image) }}" class="image-popup fh5co-board-img" title="{{ $element->title }}">-->
                                    @if(!empty($element->image))
                                    <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : mb_substr($element->description, 0, 100) }}">
                                    @else
                                    <div class="caffle" style="height: 200px;">
                                  <div class="description col-12" style='margin-top: 60px;'>
                                            <p>{{ mb_substr(strip_tags($element->description), 0, 150) }}</p>
                                    </div>
                                    </div>
                                    @endif
                                    <!--<span class="icon-corner"><i class="fa fa-video" style="color: #fff;"></i></span>-->
                                    
                                    
                                    <!--</a>-->
        		</a>
        		<div class="fh5co-desc">
                             <div class="row d-flex px-4 mt-3 flex-wrap"> 
                                 <div class="col-12 shoptitle text-center">
                                     <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ mb_substr($element->title, 0, 35) }}</a>
                                 </div>
                                 <div class="col-12 shopsubtitle text-center">
                                     <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ mb_substr($element->subtitle, 0, 40) }}</a>
                                 </div>
                             </div>
                        
                                 <div class="col-12 shopcategory text-right">
                                     <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">@if($element->product_categories) {!! $element->product_categories !!} @endif</a>
                                 </div>    
                        </div>
        	</div></div>