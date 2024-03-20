<div class="row like_line">
    <div class="col-12">
        <a href="/{{ $comm_element[0]->url }}#komentarze">
            <h4 class="mt-5" style="text-transform: uppercase; font-weight: 400;">{{ $comm_element[0]->title }}</h4>
        </a></div>
</div>
@foreach($comm_element as $comment)
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
                @if(Auth::check() && $comment->id == Auth()->user()->id && !$comment->removed_by_user)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal" data-comment-id="{{ $comment->comm_id }}"><small><i class="fa-solid fa-edit" style="color: #ef5353;"></i></small></a>
                    <a href="#" class="removeComment" data-bs-toggle="modal" data-bs-target="#removeCommentModal" data-bs-whatever="{{ route('social.comment.remove', ['element_id' => $element->element_id, 'id' => $comment->comm_id, 'redirect' => base64_encode(url()->current())]) }}"><small><i class="fa-solid fa-trash mx-2" style="color: #ef5353;"></i></small></a>
                @endif
            </div>
            <div class="col-12 comment_text @if($comment->removed_by_user) text-grey @endif">
                @if($comment->removed_by_user)
                    (komentarz usunięty przez użytkownika)
                @else
                    {{ $comment->comment }}
                @endif
            </div>
        </div>
    </div>
@endforeach