<div class="col-6 my-3 {{ $element->tags }}">
    <div class="item social p-3">
        		<div class="animate-box">
                               
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
                                        
                                        {{ $element->title }}<br/>
                                       
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
                                <span><i class="fa-regular fa-heart"></i> 34</span>
                                <span><i class="fa-regular fa-comments"></i> 2</span>
                            </div>
                       
                        
                       
                        </div>
        	</div></div>