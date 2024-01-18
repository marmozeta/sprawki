<div class="col-3 my-3 {{ $element->tags }}">
    <div class="item default">
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
                            <div class="col-12 title">
                                <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ $element->title }}</a>
                            </div>
                            <div class='icons mt-3'>
                                <span><i class="fa-regular fa-heart"></i> 34</span>
                                <span><i class="fa-regular fa-comments"></i> 2</span>
                            </div>
                       
                        
                       
                        </div>
        	</div></div>