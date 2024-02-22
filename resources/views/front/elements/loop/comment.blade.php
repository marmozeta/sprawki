 <div class="row like_line bg-white py-3">
                         <div class="col-1">
                             <a href="/{{ $comment->owner_friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $comment->owner_picture }}" alt="user" class="rounded-circle user-picture" /></a>
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
                             <a href="/{{ $comment->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $comment->picture }}" alt="user" class="rounded-circle user-picture" /></a>
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