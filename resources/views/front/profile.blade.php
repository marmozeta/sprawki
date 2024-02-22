@extends('front.layouts.app')


@section('top_buttons')
    <button class="btn btn-primary btn-sm filter-button text-bold"><i class="fa fa-users"></i>&nbsp;&nbsp; Obserwowani</button>
@endsection

@section('content')
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
                    <a><i class="fa-solid fa-users"></i> 13 obserwowanych</a>
                    <a><i class="fa-regular fa-eye"></i> 1 obserwujący</a>
                </div>
            </div>
            <div class="col-2 text-right">
                <a href="#" class="btn btn-primary">Edytuj profil</a>
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
        @if(!$comments->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="komentarze">Komentarze</h3>
                <div class="divide long"><i class="fa-regular fa-comments"></i></div>       
                    @foreach($comments as $comment)
                     <div class="row like_line bg-white py-3">
                         <div class="col-1">
                             <a href="/{{ $comment->owner_friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $comment->owner_picture }}" alt="user" class="rounded-circle" /></a>
                         </div>
                         <div class="col-11">
                              <div class="col-12">
                                  <a href="/{{ $comment->owner_friendly_name }}"><b>{{ $comment->owner_name }}</b></a> <a href="/{{ $comment->owner_friendly_name }}" class="friendly-name">{{ '@'.$comment->owner_friendly_name }}</a>
                            &nbsp;&#9679;&nbsp; 
                            {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }} 
                             </div>
                             @if($comment->comment_comm_id)
                              <div class="col-12 in_reply">
                                  W odpowiedzi do <a href="/{{ $comment->comment_friendly_name }}">{{ '@'.$comment->comment_friendly_name }}</a>
                            </div>
                             @endif
                              <div class="col-12">
                                {{ $comment->teaser }}
                            </div>
                         </div>
                         
                     <div class="col-12 text-right" style="font-size: 0.8em;">
                        <span><i class="fa-regular fa-heart"></i> <span class="count">0</span> Polub</span>
                        <span class="mx-3"><i class="fa-regular fa-comments"></i> Odpowiedz</span>
                     </div>
                          </div>
                          <div class="row like_line">
                         <div class="col-1 offset-1 bg-white py-3">
                             <a href="/{{ $comment->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $comment->picture }}" alt="user" class="rounded-circle" /></a>
                         </div>
                         <div class="col-10 bg-white py-3">
                              <div class="col-12">
                                  <a href="/{{ $comment->friendly_name }}"><b>{{ $comment->name }}</b></a> <a href="/{{ $comment->friendly_name }}" class="friendly-name">{{ '@'.$comment->friendly_name }}</a>
                            &nbsp;&#9679;&nbsp; 
                            {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }} 
                             </div>
                              <div class="col-12">
                                {{ $comment->comment }}
                            </div>
                        <div class="col-12 text-right" style="font-size: 0.8em;">
                           <span class="mx-3"><i class="fa-regular fa-heart"></i> <span class="count">0</span> Polub</span>
                        </div>
                         </div>
                          </div>
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