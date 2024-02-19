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
                                <img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="30">&nbsp;
                                <span style="text-transform: none;">@marmozeta</span>
                            </div>
                           <div class='col-4 icons justify-content-end mt-3'>
                                    <span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $element->likes }}</span></span>
                                    <span><i class="fa-regular fa-comments"></i> {{ $element->comments }}</span>
                            </div>
                       
                        
                       
                        </div>
        	</div></div>

@section('scripts')
@if(auth()->check()) 
<div class="modal fade" id="newCommentModal" tabindex="-1" aria-labelledby="newCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCommentModalLabel">Nowy komentarz</h5>
      </div>   
        <p style="margin: 0 auto 5px auto;" class="pt-3">Odpowiadasz na post:</p>
        <div class="content item default comment"></div>
        
        <form action="{{ route('social.comment.save') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-12 p-2">
                   <div class="w-100">
                    <textarea id="social_element" name="comment" class="form-control" style="width: 100%; height: 120px;" placeholder="Opublikuj swój komentarz"></textarea>
                    <input type="hidden" name="element_id" value="" />
                    <input type="hidden" name="redirect" value="" />
                    </div>
                   @csrf
        
</div> 
           
            </div>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Dodaj komentarz</button>
      </div>    </form>
    </div>
  </div>
</div>
@endif
<script>
var newCommentModal = document.getElementById('newCommentModal')
newCommentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var element_id = button.getAttribute('data-bs-element-id')
  
  var content = jQuery(button).parent().parent().parent().html();
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  var modalDivContent = newCommentModal.querySelector('div.content')
  jQuery(modalDivContent).html(content);
  
  var modalElementId = newCommentModal.querySelector('[name="element_id"]');
  modalElementId.value = element_id;
  
  var redirect = button.getAttribute('data-bs-redirect');
  var modalRedirect = newCommentModal.querySelector('[name="redirect"]');
  modalRedirect.value = redirect;
});

$('.toggle_like').on('click', function() {
    var element_id = $(this).attr('data-element-id');
    var element = $(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        type: 'POST',
        url: '{{ url("social/like/save") }}',
        data: {element_id: element_id},
        success: function (data){
            console.log(data);
            var count = parseInt(element.find('.count').html())+parseInt(data);
            element.find('.count').html(count);
            if(parseInt(data) == 1) element.find('i').removeClass('fa-regular').addClass('fa-solid');
            else element.find('i').removeClass('fa-solid').addClass('fa-regular');
            console.log("Like saved!!");
        },
        error: function(e) {
            console.log(e);
        }
    });
    return false;
})
</script>
@endsection