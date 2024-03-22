<div class="row like_line">
    <div class="col-12">
        <a href="/{{ $comm_element[0]->url }}#komentarze">
            <h4 class="mt-5" style="text-transform: uppercase; font-weight: 400;">{{ $comm_element[0]->title }}</h4>
        </a>
    </div>
</div>
@foreach($comm_element as $comment)
<a href="/{{ $comm_element[0]->url }}#comm{{ $comment->comm_id }}" class="profile-link d-block">
        <div class="row like_line">
            <div class="col-1 @if($comment->comment_comm_id > 0) offset-1 @endif bg-white py-3">
                <img src="{{ asset('images/users/') }}/{{ $comment->picture }}" alt="user" class="rounded-circle user-picture" />
            </div>
            <div class="@if($comment->comment_comm_id > 0) col-10 @else col-11 @endif bg-white py-3 d-flex flex-wrap">
                <div class="col-10">
                    <b>{{ $comment->name }}</b> <span class="friendly-name">{{ '@'.$comment->friendly_name }}</span>
                    &nbsp;&#9679;&nbsp; 
                    {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i') }} 
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
    </a>
@endforeach