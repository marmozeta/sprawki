<div class="col-3 my-3 iso-item {{ $element->tags }} ">
    <div class="item default">
        		<a href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}" class="animate-box">
                              
                                    <div class="caffle d-flex">
                                        <div class="w-100 d-flex justify-content-between">
                                         <div class="top_left">
                                             @if($element->is_read)
                                             <i class="fa-solid fa-check-circle text-success"></i>
                                             @endif
                                      <span class="publish_date">@if(!empty($element->created_at) && $element->created_at!='0000-00-00 00:00:00') {{ Carbon\Carbon::parse($element->created_at)->format('d.m.Y H:i') }} @endif</span>
                                      <div class="country">
                                            @if(is_array($menu->attrs_list) && in_array('country', $menu->attrs_list))
                                                @if(!empty($element->flag)) <span class="fi fi-{{ strtolower($element->flag) }}"></span> @endif 
                                                @if(!empty($element->country)) {{ $element->country }} @endif
                                            @elseif(is_array($menu->attrs_list) && in_array('toptitle', $menu->attrs_list))
                                                @if(!empty($element->toptitle)) {{ $element->toptitle }} @endif
                                            @else
                                                {{ $element->title }}
                                            @endif
                                        </div>
                                        </div>
                                        <div class="top_right">
                                      @if(!empty($element->image))
                                        <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}" width="100" height="56.25">
                                      @else
                                      <i class="{{ ($element->icon) ? $element->icon : $menu->icon }} fa-2x"></i>
                                        @endif
                                        </div>
                                        </div>
                                        <div class="description col-12">
                                            <p>{{ mb_substr(strip_tags($element->description), 0, 150) }}</p>
                                    </div>  </div>
                                  
        		</a>
        		<div class="fh5co-desc d-flex flex-wrap">
                            <div class="col-12 title">
                                <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ mb_substr($element->title, 0, 50) }}</a>
                            </div>
                            <div class="col-8 d-flex align-items-center" style="margin: 5px 0;">
                                @if($element->author_id > 0)
                                    <a href="/{{ $element->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $element->picture }}" alt="{{ $element->friendly_name }}" class="rounded-circle user-picture"></a>&nbsp;
                                    <a href="/{{ $element->friendly_name }}" class="text-white px-2" style="text-transform: none;">{{ '@'.$element->friendly_name }}</a>
                                @else
                                <img src="{{ asset('images/users/') }}/{{ $element->picture }}" alt="{{ $element->friendly_name }}" class="rounded-circle user-picture">&nbsp;
                                <span class="text-white px-2" style="text-transform: none;">{{ '@'.$element->friendly_name }}</span>
                                
                                @endif
                            </div>
                           <div class='col-4 icons justify-content-end align-items-center'>
                                    <span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart @if($element->likes >= $hot_likes) text-danger @endif"></i> <span class="count">{{ $element->likes }}</span></span>
                                    <span><i class="fa-regular fa-comments @if($element->comments >= $hot_comments) text-danger @endif"></i> {{ $element->comments }}</span>
                            </div>
                       
                        
                       
                        </div>
        	</div></div>
