@extends('front.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection

@section('top_buttons')
    @if(Auth::check())
        <a class="btn btn-primary btn-sm filter-button text-bold" href="/{{ Auth::user()->friendly_name }}/obserwowani#obserwowani"><i class="fa fa-users"></i>&nbsp;&nbsp; Obserwowani</a>
    @endif
@endsection

@section('content')
    @include('front.layouts.partials.filters')  
		<div class="container">

        <div id="fh5co-board" class="row">
            @foreach($elements as $element) 
            
                    @include('front.elements.loop.default')  
               
            @endforeach
        </div>
       
    @if(auth()->check())
    <button class="btn btn-primary btn-sm filter-button text-bold" id="newPostButton" data-bs-toggle="modal" data-bs-target="#newPostModal"><i class="fa fa-plus"></i>&nbsp;Nowy<br/>rozmyślunek</button>
    @else
    <button class="btn btn-primary btn-sm filter-button text-bold" id="newPostButton" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-plus"></i>&nbsp;Nowy<br/>rozmyślunek</button>
    @endif
       </div>
	
@endsection

@section('after_scripts')
@if(auth()->check()) 
<div class="modal fade" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="newPostModalLabel">Nowy rozmyślunek</h5>
      </div>   <form action="{{ route('social.post.save') }}" method="post" class="w-100" id="post-save">
              
      <div class="modal-body">
          <div class="item d-flex p-3">
                <div class="col-12 p-2">
                   <div class="w-100">
                       <input type="text" class="form-control mb-2" name="title" placeholder="Nazwij swój rozmyślunek" style="height: 36px;" />
                    <textarea id="social_desc" name="desc" class="form-control" style="width: 748px; height: 80px;" placeholder="Opublikuj swój rozmyślunek"></textarea>
                </div>
                   <input type="hidden" name="file" />
                   @csrf
        
</div> 
           
            </div>
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Dodaj rozmyślunek</button>
      </div>    </form>
    </div>
  </div>
</div>

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
                    <textarea autofocus id="social_element" name="comment" class="form-control" style="width: 100%; height: 120px;" placeholder="Opublikuj swój komentarz"></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
<script> 
bkLib.onDomLoaded(function() {  new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('social_desc');  });
bkLib.onDomLoaded(function() {  new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('social_element');  });
$('.nicEdit-panelContain').parent().width('100%');
$('.nicEdit-panelContain').parent().next().width('100%');</script>
<script>
var newCommentModal = document.getElementById('newCommentModal')
newCommentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var element_id = button.getAttribute('data-bs-element-id')
  var content = jQuery(button).parent().parent().parent().find('.animate-box').html();
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  var modalDivContent = newCommentModal.querySelector('div.content>.animate-box')
  jQuery(modalDivContent).html(content);
  
  var modalElementId = newCommentModal.querySelector('[name="element_id"]')
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