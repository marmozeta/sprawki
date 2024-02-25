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
                             @if($comment->comment_comm_id > 0)
                              <div class="col-12 in_reply">
                                  W odpowiedzi do <a href="/{{ $comment->comment_friendly_name }}">{{ '@'.$comment->comment_friendly_name }}</a>
                            </div>
                             @endif
                              <div class="col-12">
                                {{ $comment->teaser }}
                            </div>
                         </div>
                         
                     <div class="col-12 text-right" style="font-size: 0.8em;">
                        <a href="#" data-element-id="{{ $comment->element_id }}" data-comment-id="{{ $comment->comment_comm_id }}" class="toggle_like text-dark mx-3"><i class="{{ ($comment->owner_is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $comment->owner_likes }}</span> Polub</a>
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
                           <a href="#" data-element-id="{{ $comment->element_id }}" data-comment-id="{{ $comment->comm_id }}" class="toggle_like text-dark mx-3"><i class="{{ ($comment->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $comment->likes }}</span> Polub</a>
                        </div>
                         </div>
                          </div>
                        @if($comment->has_children)
                            @foreach($comment->children as $child)
                                 <div class="row like_line">
                         <div class="col-1 offset-2 bg-white py-3">
                             <a href="/{{ $child->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $child->picture }}" alt="user" class="rounded-circle user-picture" /></a>
                         </div>
                         <div class="col-9 bg-white py-3">
                              <div class="col-12">
                                  <a href="/{{ $child->friendly_name }}"><b>{{ $child->name }}</b></a> <a href="/{{ $child->friendly_name }}" class="friendly-name">{{ '@'.$child->friendly_name }}</a>
                            &nbsp;&#9679;&nbsp; 
                            {{ Carbon\Carbon::parse($child->created_at)->format('d.m.Y H:i') }} 
                             </div>
                              <div class="col-12">
                                {{ $child->comment }}
                            </div>
                        <div class="col-12 text-right" style="font-size: 0.8em;">
                           <a href="#" data-element-id="{{ $comment->element_id }}" data-comment-id="{{ $child->comm_id }}" class="toggle_like text-dark mx-3"><i class="{{ ($child->is_liked) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i> <span class="count">{{ $child->likes }}</span> Polub</a>
                        </div>
                         </div>
                          </div>
                            @endforeach
                        @endif