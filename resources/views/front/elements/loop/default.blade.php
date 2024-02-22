<div class="col-3 my-3 iso-item {{ $element->tags }} ">
    <div class="item default">
        		<a href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}" class="animate-box">
                              
                                    <div class="caffle d-flex">
                                         <div class="top_left col-6">
                                      <span class="publish_date">@if(!empty($element->created_at) && $element->created_at!='0000-00-00 00:00:00') {{ Carbon\Carbon::parse($element->created_at)->format('d.m.Y H:i') }} @endif</span>
                                        <div class="country">@if(!empty($element->country)) {!! $element->country !!} @endif</div>
                                        </div>
                                        <div class="top_right col-6">
                                      @if(!empty($element->image))
                                        <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}" width="100" height="56.25">
                                      @else
                                      <i class="{{ ($element->icon) ? $element->icon : $menu->icon }} fa-2x"></i>
                                        @endif
                                        </div>
                                       
                                        <div class="description col-12">
                                            <p>{{ mb_substr(strip_tags($element->description), 0, 150) }}</p>
                                    </div>  </div>
                                  
        		</a>
        		<div class="fh5co-desc d-flex flex-wrap">
                            <div class="col-12 title">
                                <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ mb_substr($element->title, 0, 50) }}</a>
                            </div>
                            <div class="col-8" style="margin: 5px 0;">
                                <img src="{{ asset('images/users/') }}/{{ $element->picture }}" alt="user" class="rounded-circle" width="30">&nbsp;
                                <span style="text-transform: none;">{{ '@'.$element->friendly_name }}</span>
                            </div>
                           <div class='col-4 icons justify-content-end mt-3'>
                                    <span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $element->likes }}</span></span>
                                    <span><i class="fa-regular fa-comments"></i> {{ $element->comments }}</span>
                            </div>
                       
                        
                       
                        </div>
        	</div></div>
