@extends('front.layouts.app')

@section('top_buttons')
    <a class="btn btn-primary btn-sm filter-button text-bold" data-bs-toggle="modal" data-bs-target="#newChatModal"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nowa wiadomość</a>
@endsection

@section('content')
@include('front.layouts.partials.filters')  
@csrf
<div class="container-fluid pt-5">
    <div class="container">
        <section class="cart_view container mt-2 my-3 py-5">
            <div class="row mt-2">
                <h1 class="element_title">Wiadomości</h1>
                <div class="divide"><i class="fa-solid fa-envelope"></i></div>
            </div>
            <div class="row">
                <div class="col-3">
                    <ul>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="30"> Dawid Mysior</li>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="30"> Damian Szulc</li>
                        <li><img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="30"> Artur Kośmider</li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="">
                        <img src="/public/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="30"> Dawid Mysior
                    </div>
                    <div class="my-3 bg-white">
                        konwersacja
                        
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
          <a href="#" class="btn btn-secondary w-100 mt-3 border-gray-300">Utwórz grupę</a>
       

      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" id="files_attach" data-bs-dismiss="modal">Dalej</a>
      </div>
    </div>
  </div>
</div>

<script>
   
    
    $.ajax({
                    headers: {
                                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                    type: 'POST',
                    url: '{{ url("chat/participants/get") }}',
                    data: {filename: name},
                    success: function (data){
                        var new_data = [];
                        for(var i in data) {
                            new_data.push(data[i].name);
                        }
                        // The DOM element you wish to replace with Tagify
                       var input = document.querySelector('input[name=users_list]');
                       // initialize Tagify on the above input node reference
                       new Tagify(input,
                       {whitelist: new_data, enforceWhitelist: true});
                    },
                    error: function(e) {
                        console.log(e);
                    }});
    </script>
@endsection