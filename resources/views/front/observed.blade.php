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
    </div>     
</div>
@endsection

@section('scripts')
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
    </script>
@endsection