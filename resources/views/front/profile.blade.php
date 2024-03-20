@extends('front.layouts.app')

@section('content')
@csrf
<div id="profile" class="container-fluid pt-5">
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <h1 class="element_title mt-4 pt-4 mb-0 pb-0 text-center">{{ $user->name }}</h1>
                <div class="info d-flex justify-content-center pb-5" style="column-gap: 30px;">
                    <a href="#rozmyslunki" class="text-dark"><i class="fa-solid fa-quote-right"></i> {{ count($elements) }} rozmyślunków</a>
                    <a href="#komentarze" class="text-dark"><i class="fa-regular fa-comments"></i> {{ count($comments) }} komentarzy</a>
                    <a href="#polubienia" class="text-dark"><i class="fa-regular fa-heart"></i> {{ count($likes) }} polubień</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2 bg_picture" style="background-image: url('{{ asset('images/users/') }}/{{ $user->bg_picture }}')">
            </div> 
            <div class="col-2 offset-2">
                <img src="{{ asset('images/users/') }}/{{ $user->picture }}" class="avatar_image" />
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-2">
                <h3>{{ $user->name }}</h3>
                <h4>{{ '@'.$user->friendly_name }}</h4>
                <div class="info d-flex pb-5" style="column-gap: 30px;">
                    <a href="/{{ $user->friendly_name }}/obserwowani#obserwowani"><i class="fa-solid fa-users"></i> {{ $observed }} obserwowanych</a>
                    <a href="/{{ $user->friendly_name }}/obserwowani#obserwujacy"><i class="fa-regular fa-eye"></i> {{ $is_observable }} obserwujący</a>
                </div>
            </div>
            <div class="col-2 text-right">
                @if(!Auth::check()) 
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Obserwuj</a>
                @elseif(Auth::check() && $user->id == Auth::user()->id)
                    <a href="#" class="btn btn-primary">Edytuj profil</a>
                @elseif($logged_in_is_observable)
                    <a href="#" id="is_observed" class="btn btn-primary">Obserwujesz</a>
                @else
                    <a href="#" id="add_to_observe" class="btn btn-primary">Obserwuj</a>
                @endif
            </div>
        </div>
        @if(!$elements->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="rozmyslunki">Rozmyślunki</h3>
                <div class="divide long"><i class="fa-regular fa-comments"></i></div>   
                  </div>
        </div>
        <div id="fh5co-board">
            <div class="row iso-grid">
                        @foreach($elements as $element)
                         @include('front.elements.loop.default') 
                        @endforeach    
            </div>
        </div>
    @endif
        @if(!empty($comments))
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="komentarze">Komentarze</h3>
                <div class="divide long"><i class="fa-regular fa-comments"></i></div>       
                    @foreach($comments as $comm_element)
                        @include('front.elements.loop.profile_comment') 
                    @endforeach    
            </div>
        </div>
    @endif
    @if(!$likes->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="polubienia">Polubienia</h3>
                <div class="divide long"><i class="fa-regular fa-heart"></i></div>       
                    @foreach($likes as $like)
                     <div class="row like_line bg-white py-3">
                         <div class="col-1">
                             <a href="/{{ $like->owner_friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $like->owner_picture }}" alt="user" class="rounded-circle" /></a>
                         </div>
                         <div class="col-11">
                              <div class="col-12">
                                  <a href="/{{ $like->owner_friendly_name }}"><b>{{ $like->owner_name }}</b></a> <a href="/{{ $like->owner_friendly_name }}" class="friendly-name">{{ '@'.$like->owner_friendly_name }}</a>
                            &nbsp;&#9679;&nbsp; 
                            {{ Carbon\Carbon::parse($like->created_at)->format('d.m.Y H:i') }} 
                             </div>
                             @if($like->comment_comm_id)
                              <div class="col-12 in_reply">
                                  W odpowiedzi do <a href="/{{ $like->comment_friendly_name }}">{{ '@'.$like->comment_friendly_name }}</a>
                            </div>
                             @endif
                              <div class="col-12">
                                {{ $like->teaser }}
                            </div>
                         </div>
                          </div>
                    @endforeach    
            </div>
        </div>
    @endif
    </div>     
</div>
@endsection

@section('scripts')
    @if(Auth::check())
    <script>
        $(document).on('click', '#add_to_observe', function() {
            var button = $(this);
        $.ajax({
            headers: {
                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: '{{ url("social/observed/save") }}',
                    data: {user_id: {{ Auth::user()->id }}, observed_id: {{ $user->id }}},
                    success: function (data){
                       if(data == 1) {
                           button.parent().append('<a href="#" id="is_observed" class="btn btn-primary">Obserwujesz</a>');
                           button.remove();
                       }
                    },
                    error: function(e) {
                        console.log(e);
                    }});
        return false;
    });
    
    $(document).on('mouseover', '#is_observed', function() {
        $(this).html('Przestań obserwować');
    });
    
    $(document).on('mouseout', '#is_observed', function() {
        $(this).html('Obserwujesz');
    });
    
    $(document).on('click', '#is_observed', function() {
            var button = $(this);
        $.ajax({
            headers: {
                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: '{{ url("social/observed/remove") }}',
                    data: {user_id: {{ Auth::user()->id }}, observed_id: {{ $user->id }}},
                    success: function (data){
                       if(data == 1) {
                           button.parent().append('<a href="#" id="add_to_observe" class="btn btn-primary">Obserwuj</a>');
                           button.remove();
                       }
                    },
                    error: function(e) {
                        console.log(e);
                    }});
        return false;
    });
    
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
    </script>
    @endif
@endsection