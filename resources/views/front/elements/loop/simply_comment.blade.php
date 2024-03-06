<div class="row like_line">
    <div class="col-1 @if($comment->comment_comm_id > 0) offset-1 @endif bg-white py-3">
        <a href="/{{ $comment->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $comment->picture }}" alt="user" class="rounded-circle user-picture" /></a>
    </div>
    <div class="@if($comment->comment_comm_id > 0) col-10 @else col-11 @endif bg-white py-3 d-flex flex-wrap">
        <div class="col-10">
            <a href="/{{ $comment->friendly_name }}"><b>{{ $comment->name }}</b></a> <a href="/{{ $comment->friendly_name }}" class="friendly-name">{{ '@'.$comment->friendly_name }}</a>
            &nbsp;&#9679;&nbsp; 
            {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }} 
        </div>
        <div class="col-2 text-right">
            @if(Auth::check() && $comment->id == Auth()->user()->id)
                <a href="#"><small><i class="fa-solid fa-edit" style="color: #ef5353;"></i></small></a>
                <a href="#"><small><i class="fa-solid fa-trash mx-2" style="color: #ef5353;"></i></small></a>
            @endif
        </div>
        <div class="col-12">
            {{ $comment->comment }}
        </div>
        <div class="col-12 text-right" style="font-size: 0.8em;">
            <a href="#" data-element-id="{{ $comment->element_id }}" data-comment-id="{{ $comment->comm_id }}" class="toggle_like text-dark mx-3"><i class="{{ ($comment->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $comment->likes }}</span> Polub</a>
                @if($comment->comment_comm_id == 0)
                    @if(Auth::check())
                        <a href="#" data-bs-toggle="modal" data-bs-target="#newCommentModal" class="text-dark" data-comment-id="{{ $comment->comm_id }}"><i class="fa-regular fa-comments"></i> {{ $comment->comments }} Odpowiedz</a>
                    @else
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-dark"><i class="fa-regular fa-comments"></i> {{ $comment->comments }} Odpowiedz</a>
                    @endif
                @endif
        </div>
    </div>
</div>