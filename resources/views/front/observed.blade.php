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
                    <a><i class="fa-solid fa-users"></i> {{ $observed }} obserwowanych</a>
                    <a><i class="fa-regular fa-eye"></i> {{ $is_observable }} obserwujący</a>
                </div>
            </div>
        </div>
        @if(!$observed_list->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="obserwowani">Obserwowani</h3>
                <div class="divide long"><i class="fa-regular fa-heart"></i></div>       
                    @foreach($observed_list as $observe)
                     <div class="row like_line bg-white py-3">
                         <div class="col-1">
                             <a href="/{{ $observe->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $observe->picture }}" alt="user" class="rounded-circle" /></a>
                         </div>
                         <div class="col-11">
                              <div class="col-12">
                                  <a href="/{{ $observe->friendly_name }}"><b>{{ $observe->name }}</b></a><br/><a href="/{{ $observe->friendly_name }}" class="friendly-name">{{ '@'.$observe->friendly_name }}</a>
                             </div>
                              <div class="col-12">
                                  {{ $observe->teaser }}
                             </div>
                         </div>
                          </div>
                    @endforeach    
            </div>
        </div>
    @endif
    
     @if(!$is_observable_list->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="obserwujacy">Obserwujący</h3>
                <div class="divide long"><i class="fa-regular fa-heart"></i></div>       
                    @foreach($is_observable_list as $observe)
                     <div class="row like_line bg-white py-3">
                         <div class="col-1">
                             <a href="/{{ $observe->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $observe->picture }}" alt="user" class="rounded-circle" /></a>
                         </div>
                         <div class="col-11">
                              <div class="col-12">
                                  <a href="/{{ $observe->friendly_name }}"><b>{{ $observe->name }}</b></a><br/><a href="/{{ $observe->friendly_name }}" class="friendly-name">{{ '@'.$observe->friendly_name }}</a>
                             </div>
                              <div class="col-12">
                                  {{ $observe->teaser }}
                             </div>
                         </div>
                          </div>
                    @endforeach    
            </div>
        </div>
    @endif
    
    @csrf
    @if(!$other_users->isEmpty())
        <div class="row">
            <div class="col-6 offset-3 justify-content-center mt-5" style="column-gap: 20px;">
                <h3 class="w-100 text-center" id="wyszukaj">Mogą Cię zainteresować</h3>
                <div class="divide long"><i class="fa-solid fa-search"></i></div>    
                <div class="my-3">
                    <select class="selectpicker w-100" data-live-search="true" title="Szukaj osób ...">
                        <option></option>
                        @foreach($other_users as $other)
                            <option data-content="<img src='/public/images/users/{{ $other->picture }}' width='30' class='rounded-circle' />&nbsp;&nbsp; {{ $other->name }}">{{ $other->friendly_name }}</option>
                        @endforeach
                  </select>
  </div>
                    @foreach($other_users as $o => $ouser)
                        @if($o < 10)
                        <div class="row like_line bg-white py-3">
                            <div class="col-1">
                                <a href="/{{ $ouser->friendly_name }}"><img src="{{ asset('images/users/') }}/{{ $ouser->picture }}" alt="user" class="rounded-circle" /></a>
                            </div>
                            <div class="col-11">
                                 <div class="col-12">
                                     <a href="/{{ $ouser->friendly_name }}"><b>{{ $ouser->name }}</b></a><br/><a href="/{{ $ouser->friendly_name }}" class="friendly-name">{{ '@'.$ouser->friendly_name }}</a>
                                </div>
                                 <div class="col-12">
                                     {{ $ouser->teaser }}
                                </div>
                            </div>
                             </div>
                        @endif
                    @endforeach    
            </div>
        </div>
    @endif
    </div>     
</div>
@endsection

@section('scripts')
    <script>
        
        $(function () {
            $('select').selectpicker();
    });
    
   $('.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
       actual_val = $(this).val();
       if(actual_val != '') window.location.href='/'+actual_val;
    });

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
        <a ${this.getAttributes(tagData)}
            href="/sprawki"
            class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}'
            role="option">
            ${ tagData.picture ? `
                <div class='tagify__dropdown__item__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" src="${tagData.picture}">
                </div>` : ''
            }
            <strong>${tagData.name}</strong>
            <span>@${tagData.friendly_name}</span>
        </a>
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
                if(data[i].picture == '') data[i].picture = 'person.png';
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