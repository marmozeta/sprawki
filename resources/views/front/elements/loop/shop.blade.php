<div class="col-3 my-3 {{ $element->tags }}">
    <div class="item shop">
        		<a href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}" class="animate-box">
	        		
                                    <div class="caffle" style="height: 158px;">
                                        @if(!empty($element->image))
                                        <img src="{{ asset('images/elements/'.$element->image) }}" alt="{{ (!empty($element->title)) ? $element->title : substr($element->description, 0, 100) }}" width="40" height="22.5">
                                      @endif
                                        {{ substr(strip_tags($element->description), 0, 180) }}@if(strlen($element->description) > 180) ... @endif</div>
                                  
                                  
        		</a>
        		<div class="fh5co-desc">
                             <div class="row d-flex px-4 mt-1"> 
                                 <div class="col-8 title">
                                     <a class="text-white" href="{{ $menu->slug }}/{{$element->element_id}}-{{ $element->slug }}">{{ substr($element->title, 0, 40) }}@if(strlen($element->title) > 40) ... @endif</a>
                                 </div>
                                 <div class="col-4 price">{{ number_format($element->price*(1+$element->vat/100), 2, ',', ' ') }} zł</div>
                             </div>
                                 <div class="row d-flex px-4 mt-1"> 
                                         @if(!$element->is_virtual)
                                     <div class="col-8">
                                     
            <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="quantity" class="form-control input-number cart-item" value="1" min="1" max="99999">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
            </div>  
                                     </div>
                   <div class="col-4" style="text-align: right; padding-right: 10px;">
                 <button class="btn btn-primary btn-sm filter-button text-bold add_to_cart" data-element-id="{{ $element->element_id }}">
                     <i class="fa-solid fa-cart-shopping"></i>
                 </button>
             
              </div>
                                         @else
                                         <div class="col-12">
                 <button class="btn btn-primary btn-sm filter-button text-bold add_to_cart w-100 mr-2" data-element-id="{{ $element->element_id }}">
                     <i class="fa-solid fa-cart-shopping"></i>
                 </button>
             
                                     <input type="hidden" name="quantity" value="1" />
                                         </div>
                                     @endif
                               
                            </div>
                        
                       
                        </div>
        	</div></div>