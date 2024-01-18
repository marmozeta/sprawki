<div class="form-group mb-3">
    <label class="form-label">Pliki do wysłania @if($attr->required) * @endif</label>
    <div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filesModal">Wybierz pliki z biblioteki</a></td>  
        <input type="hidden" name="files_to_send" value="{{ $element->files_to_send }}" />
        <br/><br/>
        @if(!empty($element->files_to_send))
            Załączone pliki:<br/>
            <ul>
            @foreach(explode(',', $element->files_to_send) as $file)
            <li>{{ $file }}&nbsp;<a href='#' class='remove_file'><i class="fa fa-remove"></i></a></li>
            @endforeach
            </ul>
        @endif
    </div>
</div>

<div class="modal fade" id="filesModal" tabindex="-1" aria-labelledby="filesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filesModalLabel">BIBLIOTEKA MEDIÓW</h5>
      </div>
      <div class="modal-body">
          <div class="dropzone" id="files-dropzone"></div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" id="files_attach" data-bs-dismiss="modal">Załącz</a>
      </div>
    </div>
  </div>
</div>

@section('scripts2')
<script>
Dropzone.options.filesDropzone =
         {
            url: "{{url('admin/media/store')}}",
            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
            dictDefaultMessage: 'kliknij aby dodać pliki' ,
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif, .pdf, .mp4, .zip",
            addRemoveLinks: true,
            timeout: 50000,
            previewTemplate: document.querySelector('#template-container-files').innerHTML,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
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
            },
            error: function(file, response)
            {
               return false;
            },
            init: function() {
                var myDropzone = this;
                 $.getJSON('{{ url("admin/media/fileslist") }}', function(data) {
                     for (var i = 0; i < data.length; i++) {
                       var mockFile = { name: data[i].filename };
                       myDropzone.emit("addedfile", mockFile); 
                       myDropzone.emit("thumbnail", mockFile, '/public/media/'+data[i].filename);
                       myDropzone.files.push(mockFile);
               }
                });   
             }
};

$(document).on('click', '#files_attach', function() {
    var tab = [];
    $('.plik').each(function() {
        if($(this).is(':checked')) {
            tab.push($(this).parent().parent().find('.dz-filename span').html())
        }
    });
    $('input[name="files_to_send"]').val(tab.join(','));
    return false;
});

$(document).on('click', '.remove_file', function() {
    var filename = $(this).attr('data-name');
    var files_list = $('input[name="files_to_send"]').val().split(',');
    const index = files_list.indexOf(filename);
    files_list.splice(index, 1);
    $('input[name="files_to_send"]').val(files_list.join(','));
    $(this).parent().remove(); 
});
</script>
@endsection
<div id="template-container-files" class="d-none">
    <div class="dz-preview dz-image-preview">
     <div class="dz-image"><img data-dz-thumbnail /></div> 
     <div class="form-check" style="position: absolute; top: -10px; right: -10px; z-index: 9999;">
        <input class="form-check-input dropzone-check plik" type="checkbox" name="plik[]" role="switch" >
    </div>
  <div class="dz-details">
    <div class="dz-filename"><span data-dz-name></span></div>
  </div>
  <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>
</div>