<div class="container">
    <div class="row mt-5">
        <div class="col-8 offset-2 text-center">
            <h1 class="element_title mt-4 pt-5 text-center">{{ $element->title }}</h1>
        </div>
        @if(!empty($element->image))
        <div class="col-8 offset-2 image my-4">
            <div class="divide long"><i class="fa-solid fa-video"></i></div>
            <img class="img-fluid rounded" src="{{ asset('images/elements/'.$element->image) }}" />
        </div>
        @elseif(!empty($element->youtube))
        <div class="col-8 offset-2 image my-4">
            <iframe class="rounded" id="ytplayer" type="text/html" width="100%" height="480" src="{{ $element->youtube }}" frameborder="0"></iframe>
        </div>
        @endif
        
    </div>
    <div class="row content">
        <div class="col-8 offset-2 mt-3">
            <div class="container-fluid" style="padding: 0 7rem;">
                {!! $element->description !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2 d-flex justify-content-center mt-5" style="column-gap: 20px;">
            <div class="container-fluid mx-5 bottom_buttons">
                
                <a href="#" data-element-id="{{ $element->element_id }}" class="toggle_like text-white"><span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $element->likes }}</span> Polub</span></a>
                @if(Auth::check())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#newCommentModal" class="text-white"><i class="fa-regular fa-comments"></i> {{ $element->comments }} Skomentuj</a>
                @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-white"><i class="fa-regular fa-comments"></i> {{ $element->comments }} Skomentuj</a>
                @endif
                @if(!$arguments->isEmpty()) <a href="#argumenty"><span><i class="fa-solid fa-hand-point-up"></i> {{ count($arguments) }} Zobacz argumenty</span></a> @endif   
                </div>
        </div>
    </div>
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
                     <!--<div class="col-12 text-right" style="font-size: 0.8em;">
                        <span><i class="{{ ($element->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">5</span> Polub</span>
                        <span class="mx-3"><i class="fa-regular fa-comments"></i> Odpowiedz</span>
                     </div>-->
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
        <p style="margin: 0 auto 5px auto;" class="pt-3">Odpowiadasz na post:</p>
        <div class="content item default comment">{{ $element->title }}</div>
        
        <form action="{{ route('social.comment.save') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-12 p-2">
                   <div class="w-100">
                    <textarea id="social_element" name="comment" class="form-control" style="width: 100%; height: 120px;" placeholder="Opublikuj swój komentarz"></textarea>
                    <input type="hidden" name="element_id" value="{{ $element->element_id }}" />
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
@endif
<script>
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