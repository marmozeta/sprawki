<div class="dropzone" id="dropzone"></div>

@section('scripts')
<script type="text/javascript">
        Dropzone.options.dropzone =
         {
            url: "{{url('admin/media/store')}}",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: $('input[name="_accepted_files"]').val(),
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