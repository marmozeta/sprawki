@extends('front.layouts.app')

@section('top_buttons')
    <a class="btn btn-primary btn-sm filter-button text-bold" data-bs-toggle="modal" data-bs-target="#newChatModal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nowa wiadomość</a>
@endsection

@section('content')
@include('front.layouts.partials.filters')  
@csrf
<div id="chat" class="container-fluid pt-5">
    <div class="container">
        <section class="cart_view container mt-2 my-3 py-5">
            <div class="row mt-2">
                <h1 class="element_title">Wiadomości</h1>
                <div class="divide"><i class="fa-solid fa-envelope"></i></div>
            </div>
            <div class="row">
                <div class="col-3">
                    <ul class="persons">
                        <li class="active"><img src="{{ asset('images/person.png') }}" class="rounded-circle" width="50" /><div><span>NOWA WIADOMOŚĆ</span></div></li>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="50"> <div><span>Dawid Mysior</span><small>@dawidmysior</small></div></li>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="50"> <div><span>Regina Szulc-Andrzejewska</span><small>@reginaszulc</small></div></li>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="50"> <div><span>Dawid Mysior</span><small>@dawidmysior</small></div></li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="recipient_area">
                        @foreach($participants as $participant)
                        <img src="/public/images/users/{{ $participant->picture }}" alt="user" class="rounded-circle user-picture" width="30"> {{ $participant->name }}     
                      @endforeach
                    </div>
                    <div class="my-3 bg-white">
                        @foreach($messages as $message)
                        <div>
                            <img src="/public/images/users/{{ $message->sender->picture }}" alt="user" class="rounded-circle user-picture" width="30">
                            {{ $message->sender->name }}
                            <br/>
                            {{ $message->body }}
                        </div>
                        @endforeach
                    </div>
                    <div><textarea class="form-control"></textarea></div>
                    </div>
            </div>
            
            
        </section>

    </div></div>
@endsection


@section('scripts')
<div class="modal fade" id="newChatModal" tabindex="-1" aria-labelledby="newChatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newChatModalLabel">Nowa wiadomość</h5>
      </div>
      <div class="modal-body">
          <div class="form-group">
        <input type="text" class="form-control form-control-for-tags" placeholder="Szukaj osób" name="users_list">
    </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" id="start_chat" data-bs-dismiss="modal">Dalej</a>
      </div>
    </div>
  </div>
</div>

<script>
    $('#start_chat').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: '{{ url("chat/messenger/new") }}',
            data: {userslist: $('input[name="users_list"]').val()},
            success: function (data){
                console.log(data);
                window.location.href = '{{ route("front.chat") }}/'+data;
                },
            error: function(e) {
                console.log(e);
            }
    });
    });
    
    if($('input[name="users_list"]').length>0) {
        
   function tagTemplate(tagData){
    return `
        <tag title="${tagData.email}"
                contenteditable='false'
                spellcheck='false'
                tabIndex="-1"
                class="tagify__tag ${tagData.class ? tagData.class : ""}"
                ${this.getAttributes(tagData)}>
            <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
            <div>
                <div class='tagify__tag__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" src="${tagData.picture}">
                </div>
                <span class='tagify__tag-text'>${tagData.name}</span>
            </div>
        </tag>
    `
}

function suggestionItemTemplate(tagData){
    return `
        <div ${this.getAttributes(tagData)}
            class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}'
            tabindex="0"
            role="option">
            ${ tagData.picture ? `
                <div class='tagify__dropdown__item__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" src="${tagData.picture}">
                </div>` : ''
            }
            <strong>${tagData.name}</strong>
            <span>@${tagData.friendly_name}</span>
        </div>
    `
}

function dropdownHeaderTemplate(suggestions){
    return `
        <header data-selector='tagify-suggestions-header' class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong style='grid-area: add'>${this.value.length ? `Add Remaning` : 'Add All'}</strong>
            <span style='grid-area: remaning'>${suggestions.length} members</span>
            <a class='remove-all-tags'>Remove all</a>
        </header>
    `
}
     
        
        
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        type: 'POST',
        url: '{{ url("chat/participants/get") }}',
        success: function (data){
            var new_data = [];
            for(var i in data) {
                new_data.push({ name: data[i].name, value: data[i].id, picture: '/public/images/users/'+data[i].picture, friendly_name: data[i].friendly_name });
            }
            
            console.log(new_data);
            // The DOM element you wish to replace with Tagify
            var input = document.querySelector('input[name=users_list]');
            // initialize Tagify on the above input node reference
            new Tagify(input,
                {whitelist: new_data, 
                    enforceWhitelist: true,
                tagTextProp: 'name', // very important since a custom template is used with this property as text
    // enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
        closeOnSelect: false,
        enabled: 0,
        classname: 'users-list',
        searchKeys: ['name', 'friendly_name']  // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
        tag: tagTemplate,
        dropdownItem: suggestionItemTemplate
    }
        });
            },
        
        error: function(e) {
            console.log(e);
        }
    });
    }
    </script>
@endsection