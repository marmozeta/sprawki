<div class="form-group mb-3">
    <label class="form-label">Obrazek @if($attr->required) * @endif</label>
    <main class="page row">
	<!-- input file -->
	<div class="box col-12 mb-3">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">Wybierz obrazek z biblioteki</a></td>
                <input type="hidden" name="image" value="{{ old('image', $element->image ?? '') }}" />
	</div>
	<!-- leftbox -->
	<div class="box-2 col-4 left-box d-none">
		<div class="result"></div>
	</div>
	<!--rightbox-->
	<div class="box-2 img-result {{(!isset($element->image))?'d-none':''}} col-4 px-0" style="margin-left: 15px;">
		<!-- result of crop -->
		<img class="cropped" src="/public/images/elements/{{ old('image', $element->image ?? '') }}" alt="">
                @if(isset($element->image))
                <a href='#' class="removeUploadedImg" onClick="$(this).parent().find('.cropped').attr('src', '');$(this).remove();$('input[name=\'image\']').val('');"><i class="fa fa-remove"></i></a>
                @endif
	</div>
	<!-- input file -->
	<div class="box">
		<div class="options d-none">
		</div>
		<!-- save btn -->
		<button class="btn save d-none">Przytnij zdjęcie</button>
	</div>
</main>
</div>
                                                
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">BIBLIOTEKA MEDIÓW</h5>
      </div>
      <div class="modal-body">
          <div class="dropzone" id="images-dropzone"></div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" data-bs-dismiss="modal">Załącz</a>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Usuń plik";
        Dropzone.options.imagesDropzone =
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
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            previewTemplate: document.querySelector('#template-container-images').innerHTML,
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
                file.previewTemplate.querySelector('.dz-filename').innerHTML = "<span data-dz-name=''>"+response.filename+"</span>";
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

   let result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    img_h = document.querySelector('.img-h'),
    options = document.querySelector('.options'),
    save = document.querySelector('.save'),
    cropped = document.querySelector('.cropped'),
    dwn = document.querySelector('.download'),
    upload = document.querySelector('#file-input'),
    cropper = '';

$(document).on('click', 'input[name="plik"]', function() {
    var img_src = '/public/media/'+$(this).parent().parent().find('.dz-filename span').html();

    let img = document.createElement('img');
    img.id = 'image';
    img.src = img_src
    result.innerHTML = '';
    result.appendChild(img);
    
    let removeButton = document.createElement('i');
    removeButton.classList.add('fa');
    removeButton.classList.add('fa-remove');
    removeButton.id = 'removeImgButton';
    result.appendChild(removeButton);
                                
    // show save btn and options
    save.classList.remove('d-none');
    options.classList.remove('d-none');
    // init cropper
    cropper = new Cropper(img);
    cropper.setAspectRatio(1.777777);
    $('.left-box').removeClass('d-none');
});


save.addEventListener('click',(e)=>{
  e.preventDefault();
  // get result to data uri
  let imgSrc = cropper.getCroppedCanvas({
		width: 1280,
                height: 720
	}).toBlob((blob) => {
        const formData = new FormData();

        // Pass the image file name as the third parameter if necessary.
        formData.append('croppedImage', blob/*, 'example.png' */);
        formData.append('_token', $('input[name="_token"]').val());
        // Use `jQuery.ajax` method for example
        $.ajax('/admin/element/upload_file', {
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success(result) {
            console.log(result);
            cropped.src = '/public/images/elements/'+result;
            $('input[name="image"]').val(result);
          },
          error() {
            console.log('Upload error');
          },
        });
      }/*, 'image/png' */);
  // remove hide class of img
  cropped.classList.remove('d-none');
  img_result.classList.remove('d-none');
  $('.removeUploadedImg').hide();
});

$(document).on('click', '#removeImgButton', function() {
   $(this).parent().find('img').remove();
   cropper.destroy();
   $(this).parent().parent().parent().parent().find('.cropped').attr('src', '');
   $(this).remove();
   $('input[name=\'image\']').val('');
});
</script>
@endsection
<div id="template-container-images" class="d-none">
    <div class="dz-preview dz-image-preview">
     <div class="dz-image"><img data-dz-thumbnail /></div> 
     <div class="form-check" style="position: absolute; top: -10px; right: -10px; z-index: 9999;">
        <input class="form-check-input dropzone-check" type="radio" name="plik" />
    </div>
  <div class="dz-details">
    <div class="dz-filename"><span data-dz-name></span></div>
  </div>
  <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>
</div>