<div class="col-12 my-3 iso-item">
    <div class="item default">
        		<a href="/reklamy/{{$ad_element->element_id}}-{{ $ad_element->slug }}">
                              
                                    <div class="d-flex">
                                        <div class="w-100 d-flex justify-content-between" style="position: relative;">
                                            <img src="{{ asset('images/elements/'.$ad_element->image) }}" alt="{{ (!empty($ad_element->title)) ? $ad_element->title : substr($ad_element->description, 0, 100) }}" width="100%">
                                     
                                            <div style="position: absolute; bottom: 0; right: 0; padding: 5px 15px; border-top-left-radius: 5px; background: #fff; opacity: 0.8;">REKLAMA</div>
                                        </div> </div>
                                  
        		</a>
        	</div></div>
