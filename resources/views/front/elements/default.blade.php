<div class="container">
    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h1 class="element_title pt-5 text-center mb-0 @if($element->removed_by_user) text-grey @endif">
                @if($element->removed_by_user)
                    (rozmyślunek usunięty przez użytkownika)
                @else
                    {{ $element->title }}
                @endif
            @if($menu->is_social && Auth::check() && $element->user_id == Auth()->user()->id && !$element->removed_by_user)
                <a href="#" data-bs-toggle="modal" data-bs-target="#editPostModal"><small><i class="fa-solid fa-edit" style="color: #ef5353;"></i></small></a>
                <a href="#" class="removeComment" data-bs-toggle="modal" data-bs-target="#removePostModal" data-bs-whatever="{{ route('social.post.remove', ['element_id' => $element->element_id]) }}"><small><i class="fa-solid fa-trash" style="color: #ef5353;"></i></small></a>
            @endif
            </h1>
            <div class="info d-flex justify-content-center mt-5 mb-0" style="column-gap: 30px; padding-left: 8em; padding-right: 9em;">
                <div class="col-4">
                    @if( $element->author_id > 0)
                    <a href="/{{ $element->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $element->picture }}" alt="{{ $element->friendly_name }}" class="rounded-circle user-picture"></a>&nbsp;
                    <a href="/{{ $element->friendly_name }}" class="text-dark px-2" style="text-transform: none;">{{ '@'.$element->friendly_name }}</a>
                    @else
                    <img src="{{ asset('images/users/') }}/person.png" alt="{{ $element->friendly_name }}" class="rounded-circle user-picture">&nbsp;
                    <span class="text-dark px-2" style="text-transform: none;">{{ '@'.$element->friendly_name }}</span>
                    
                    @endif
                </div>
                <div class="col-4 align-self-center text-dark">
                    @if(!empty($element->created_at) && $element->created_at!='0000-00-00 00:00:00') {{ Carbon\Carbon::parse($element->created_at)->format('d.m.Y H:i') }} @endif
                </div>
                <div class="col-4 d-flex align-self-center justify-content-end" style="column-gap: 10px;">
                   @if(!$element->removed_by_user)
                   <a target="_blank" class="twitter-share-button"
                       href="https://twitter.com/intent/tweet?title={{ $element->text_for_social }}&url={{ url()->current() }}"><i class="fa-brands fa-x-twitter"></i></a> 
                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $element->text_for_social }}"><i class="fa-brands fa-linkedin"></i></a>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa-brands fa-facebook"></i></a> 
                    <a href="#" id="copyText" data-link="{{ url()->current() }}"><i class="fa-solid fa-link"></i></a>
                    @endif
                </div>
            </div>
        </div>
        @if(!$element->removed_by_user)
            @if(!empty($element->image))
            <div class="col-8 offset-2 image mb-2">
                <div class="divide long"><i class="fa-solid fa-video"></i></div>
                <img class="img-fluid rounded" src="{{ asset('images/elements/'.$element->image) }}"  style="padding: 0 5em;"/>
            </div>
            @elseif(!empty($element->youtube))
            <div class="col-8 offset-2 image mb-2">
                <iframe class="rounded" id="ytplayer" type="text/html" width="100%" height="400" src="{{ $element->youtube }}" frameborder="0" style="padding: 0 5em;"></iframe>
            </div>
            @endif
         @endif
    </div>
      @if(!$element->removed_by_user)
        <div class="row content mb-5">
            <div class="col-8 offset-2 mt-3">
                <div class="container-fluid element-content" style="padding: 0 7rem;">
                    {!! $element->description !!}
                </div>
            </div>
        </div>
        @if(!$product_tags->isEmpty())
        <div class="row">
            <div class="col-8 offset-2 d-flex justify-content-center my-3" style="column-gap: 10px;">
                Tagi: @foreach($product_tags as $tag) <a href="/{{ $menu->slug }}?tag={{ urlencode($tag->name) }}">{{ $tag->name }}</a> @endforeach
            </div>
        </div>
        @endif
        
    @else
    <div class="my-5"></div>
    @endif
    <div class="row">
        <div class="col-8 offset-2 d-flex justify-content-center" style="column-gap: 20px;">
            <div class="container-fluid mx-5 bottom_buttons">
                
                <a href="#" data-element-id="{{ $element->element_id }}" class="toggle_like"><span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart @if($element->likes >= $hot_likes) text-danger @else text-white @endif"></i> <span class="count">{{ $element->likes }}</span> Polub</span></a>
                @if(Auth::check())
                <a href="#" data-bs-toggle="modal" data-bs-target="#newCommentModal" data-bs-element-id='{{ $element->element_id }}' data-comment-id='0'><i class="fa-regular fa-comments @if($element->comments >= $hot_comments) text-danger @else text-white @endif"></i> {{ $element->comments }} Skomentuj</a>
                @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-white"><i class="fa-regular fa-comments @if($element->comments >= $hot_comments) text-danger @else text-white @endif"></i> {{ $element->comments }} Skomentuj</a>
                @endif
                @if(!$arguments->isEmpty()) <a href="#argumenty"><span><i class="fa-solid fa-hand-point-up"></i> {{ count($arguments) }} Zobacz argumenty</span></a> @endif   
                </div>
        </div>
    </div>
    
    @if(!empty($ad_element) && $element->menu_id != 9)
    <div class="row">
        <div class="col-12 py-5">
             @include('front.elements.loop.ad') 
        </div>
    </div>
    @endif
    
    @if(!$comments->isEmpty())
    <div class="row">
        <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
            <h3 class="w-100 text-center" id="komentarze">Komentarze</h3>
            <div class="divide long"><i class="fa-regular fa-comments"></i></div>       
                @foreach($comments as $comment)
                    @include('front.elements.loop.simply_comment') 
                @endforeach
                   
        </div>
    </div>
    @endif
    @if(!$arguments->isEmpty())
    <div class="row">
        <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
            <h3 class="w-100 text-center" id="argumenty">Argumenty</h3>
            <div class="divide long"><i class="fa-solid fa-hand-point-up"></i></div>       
                @foreach($arguments as $argument)
                 <div class="row argument_line">
                    <div class="col-12 argument_number">
                        Argument # {{ $argument->ordinal_number }}
                    </div>
                    <div class="col-12 argument_desc">
                    {{ $argument->description }}
                    </div>
                      </div>
                @endforeach
                   
        </div>
    </div>
    @endif
</div>

@section('scripts')
@if(auth()->check()) 
<div class="modal fade" id="newCommentModal" tabindex="-1" aria-labelledby="newCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCommentModalLabel">Nowy komentarz</h5>
      </div>  
        <form action="{{ route('social.comment.save') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-12 p-2">
                   <div class="w-100">
                    <textarea id="social_element" name="comment" class="form-control" style="width: 450px; height: 120px;" placeholder="Opublikuj swój komentarz"></textarea>
                    <input type="hidden" name="element_id" value="" />
                    <input type="hidden" name="comment_id" value="" />
                    <input type="hidden" name="redirect" value="{{ Request::path() }}#komentarze" />
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
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCommentModalLabel">Edytuj komentarz</h5>
      </div>  
        <form action="{{ route('social.comment.update') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-12 p-2">
                   <div class="w-100">
                    <textarea id="social_element" name="comment" class="form-control required" required style="width: 450px; height: 120px;" placeholder="Opublikuj swój komentarz"></textarea>
                    <input type="hidden" name="element_id" value="" />
                    <input type="hidden" name="comment_id" value="" />
                    <input type="hidden" name="redirect" value="{{ Request::path() }}#komentarze" />
                    </div>
                   @csrf
        
</div> 
           
            </div>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Edytuj komentarz</button>
      </div>    </form>
    </div>
  </div>
</div>
@endif
<script>
$('.toggle_like').on('click', function() {
    var element_id = $(this).attr('data-element-id');
    var comment_id = $(this).attr('data-comment-id');
    var element = $(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        type: 'POST',
        url: '{{ url("social/like/save") }}',
        data: { element_id: element_id, comment_id: comment_id },
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

$('#copyText').on('click', function() {
  var copyText = $(this).attr('data-link');
  navigator.clipboard.writeText(copyText);
});

$(document).on('click', '.removeComment', function() {
    
})
</script>
@endsection

@section('after_scripts')
@if($menu->is_social && Auth::check() && $element->user_id == Auth()->user()->id)
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="newPostModalLabel">Edytuj rozmyślunek</h5>
      </div>   <form action="{{ route('social.post.update') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-9 p-2">
                   <div class="w-100">
                       <input type="text" class="form-control mb-2" name="title" placeholder="Nazwij swój rozmyślunek" value="{{ $element->title }}" style="height: 36px;" />
                    <textarea id="social_desc" name="desc" class="form-control" style="width: 560px; height: 80px;" placeholder="Opublikuj swój rozmyślunek">{{ $element->description }}</textarea>
                </div>
                   <input type="hidden" name="file" />
                   <input type="hidden" name="element_id" value="{{ $element->element_id }}"/>
                   @csrf
        
</div>
    <div class="col-3 p-2">
      <div class="dropzone" id="add-media"></div>
    </div>  
           
            </div>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Zapisz rozmyślunek</button>
      </div>    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="removePostModal" tabindex="-1" aria-labelledby="removePostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-filled bg-white">
      <div class="modal-header">
        <h5 class="modal-title" id="removePostModalLabel">UWAGA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3">
          Czy na pewno chcesz usunąć ten rozmyślunek?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <a class="btn btn-primary">Tak, usuń</a>
      </div>
    </div>
  </div>
</div>
<script>
      
    var removePostModal = document.getElementById('removePostModal')
    removePostModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget

    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    var modalFooterLink = removePostModal.querySelector('.modal-footer a')

    modalFooterLink.href = recipient;
  })

    </script>
@endif
<div class="modal fade" id="removeCommentModal" tabindex="-1" aria-labelledby="removeCommentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-filled bg-white">
      <div class="modal-header">
        <h5 class="modal-title" id="removeCommentModalLabel">UWAGA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3">
          Czy na pewno chcesz usunąć ten komentarz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <a class="btn btn-primary">Tak, usuń</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
<script> 
bkLib.onDomLoaded(function() {  new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('social_desc');  });
bkLib.onDomLoaded(function() {  new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('social_element');  });
$('.nicEdit-panelContain').parent().width('100%');
$('.nicEdit-panelContain').parent().next().width('100%');</script>
<script>
Dropzone.options.addMedia =
         {
               url: "{{url('social/media/store')}}",
            dictDefaultMessage: 'kliknij aby dodać obrazek [opcjonalnie]' ,
            maxFilesize: 12,
            
                    headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                    type: 'POST',
                    url: '{{ url("social/media/remove") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
            success: function(file, response) 
            {
                $('input[name="file"]').val(response.filename);
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};

var newCommentModal = document.getElementById('newCommentModal')
newCommentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var element_id = button.getAttribute('data-bs-element-id')
  var comment_id = button.getAttribute('data-comment-id')
  
  var modalElementId = newCommentModal.querySelector('[name="element_id"]')
  modalElementId.value = element_id;
    
  var modalCommentId = newCommentModal.querySelector('[name="comment_id"]')
  modalCommentId.value = comment_id;
  
  var modalDesc = newCommentModal.querySelector('[name="desc"]')
  modalDesc.value = '';
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

    var removeCommentModal = document.getElementById('removeCommentModal')
    removeCommentModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget

    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    var modalFooterLink = removeCommentModal.querySelector('.modal-footer a')

    modalFooterLink.href = recipient;
  })

var editCommentModal = document.getElementById('editCommentModal')
editCommentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var element_id = button.getAttribute('data-bs-element-id')
  var comment_id = button.getAttribute('data-comment-id')
  
  var modalElementId = editCommentModal.querySelector('[name="element_id"]')
  modalElementId.value = element_id;
    
  var modalCommentId = editCommentModal.querySelector('[name="comment_id"]')
  modalCommentId.value = comment_id;
  
  var modalComment = editCommentModal.querySelector('[name="comment"]')
  modalComment.value = jQuery(button).parent().parent().parent().find('.comment_text').html().trim();
});
</script>
@endsection