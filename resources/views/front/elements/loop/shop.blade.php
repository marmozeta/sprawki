<div class="col-3 my-3 {{ $element->tags }}">
    <div class="item shop">
        		<a href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}" class="animate-box">
	        		<!--<a href="{{ asset('images/elements/'.$element->image) }}" class="image-popup fh5co-board-img" title="{{ $element->title }}">-->
                                    @if(!empty($element->image))
                                    <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}">
                                    @else
                                    <div class="caffle" style="height: 200px;">
                                  
                                        {{ substr(strip_tags($element->description), 0, 200) }}@if(strlen($element->description) > 200) ... @endif</div>
                                    @endif
                                    <!--<span class="icon-corner"><i class="fa fa-video" style="color: #fff;"></i></span>-->
                                    
                                    
                                    <!--</a>-->
        		</a>
        		<div class="fh5co-desc">
                             <div class="row d-flex px-4 mt-3"> 
                                 <div class="col-8 title">
                                     <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ substr($element->title, 0, 50) }}@if(strlen($element->title) > 50) ... @endif</a>
                                 </div>
                                 <div class="col-4 price">{{ number_format($element->price*(1+$element->vat/100), 2, ',', ' ') }} zł</div>
                             </div>
                        
                       
                        </div>
        	</div></div>