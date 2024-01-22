@extends('admin.layouts.app')

@section('styles')
<meta name="_token" content="{{csrf_token()}}" />
@endsection

@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Biblioteka mediów</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">Tablica</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Media</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-end">
                            <a class="btn waves-effect waves-light btn-rounded btn-primary" href="#" id="new_file">Nowy plik</a>
                        </div>
                    </div>
                </div>
            </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
    <form method="post" action="{{url('admin/media/store')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
    @csrf
</form>  
</div></div></div>
@endsection

@section('scripts')
<script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            clickable: '#new_file',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file) 
            {
                var name = file.name;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ url("admin/media/remove") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            },
            init: function() {
                var myDropzone = this;

                 $.getJSON('{{ url("admin/media/fileslist") }}', function(data) {
                     for (var i = 0; i < data.length; i++) {
                        console.log(data[i]);
                       var mockFile = { name: data[i].filename };
                       myDropzone.emit("addedfile", mockFile); 
                       myDropzone.emit("thumbnail", mockFile, '/public/media/'+data[i].filename);
                   myDropzone.files.push(mockFile);
               }
                });       
             }
};


</script>
@endsection