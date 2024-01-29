<div class="col-6 my-3 {{ $element->tags }}">
    <div class="item social">
        		<div class="animate-box p-3">
                               
                                    <span class="icon-corner"><i class="fa-solid fa-quote-right"></i></span>
                                    <span class="user-name">@marmozeta &nbsp;&#9679;&nbsp; @if(!empty($element->created_at) && $element->created_at!='0000-00-00 00:00:00') {{ Carbon\Carbon::parse($element->created_at) }} @endif
                       </span>
                               
	        		<!--<a href="{{ asset('images/elements/'.$element->image) }}" class="image-popup fh5co-board-img" title="{{ $element->title }}">-->
                                   
                                    <div class="row" style="height: 30px;">
                                        <div class="col-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                <div class="caffle" style="height: 170px;">
                            <div class="col-8 px-2">
                                        {{ substr(strip_tags($element->description), 0, 200) }}@if(strlen($element->description) > 200) ... @endif
                            </div>
                                        <div class="col-4 px-2">
                                             @if(!empty($element->image))
                                    <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}" class="img-fluid img-thumbnail" />
                                    @endif
                                        </div>
                            </div>
                                   
        		</div>
        		<div class="fh5co-desc">
                            <div class="col-12 title">
                               &nbsp;
                            </div>
                            
                            <div class='icons'>
                                @if(Auth::check())
                                    <a href="#" data-element-id="{{ $element->element_id }}" class="toggle_like text-white"><span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $element->likes }}</span></span></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#newCommentModal" data-bs-element-id="{{ $element->element_id}}" data-bs-redirect="{{ Request::path() }}" class="text-white"><i class="fa-regular fa-comments"></i> {{ $element->comments }}</a>
                                @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="toggle_like text-white"><span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $element->likes }}</span></span></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-white"><i class="fa-regular fa-comments"></i> {{ $element->comments }}</a>
                                @endif
                            </div>
                       
                        
                       
                        </div>
        	</div></div>