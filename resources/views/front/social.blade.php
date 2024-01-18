@extends('front.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection

@section('content')
    @include('front.layouts.partials.filters')  
    
    <div class="container px-5">
        <div class="row bg-white p-3 mt-5" style="border-radius: 10px;">
            <div class="col-3 d-flex align-items-center"><button class="btn btn-primary btn-sm filter-button text-bold"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nowy rozmyślunek</button></div>
            <div class="col-3 d-flex align-items-center"></div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <h4 class="product_title m-0">Obserwowani</h4>&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="https://sprawkidev.srv28629.microhost.com.pl/public/images/users/profile-pic.jpg" class="img-circle" style="max-width: 30px;"/>&nbsp;
                <img src="https://sprawkidev.srv28629.microhost.com.pl/public/images/users/profile-pic.jpg" class="img-circle" style="max-width: 30px;"/>&nbsp;
                <img src="https://sprawkidev.srv28629.microhost.com.pl/public/images/users/profile-pic.jpg" class="img-circle" style="max-width: 30px;"/>&nbsp;
                <img src="https://sprawkidev.srv28629.microhost.com.pl/public/images/users/profile-pic.jpg" class="img-circle" style="max-width: 30px;"/>&nbsp;
                <img src="https://sprawkidev.srv28629.microhost.com.pl/public/images/users/profile-pic.jpg" class="img-circle" style="max-width: 30px;"/>&nbsp;
                <button class="btn btn-outline-danger btn-sm filter-button text-bold" style="margin-right: 0;">Więcej <i class="fa fa-arrow-right"></i></button> </div>
        </div>
    </div>
		<div class="container">

        <div id="fh5co-board" class="row">
            <div class="col-6 d-flex p-3 d-none">
        <div class="item d-flex p-3">
                <div class="col-8 p-2">
                    <form action="" method="post" class="w-100">
                    <input type="text" class="form-control mb-3" placeholder="Tytuł rozmyślunku..." />
                <div class="w-100">
                    <textarea id="social_element" class="form-control" style="width: 355px;" placeholder="Treść rozmyślunku"></textarea>
                </div>
                 <button class="btn btn-primary mt-4 w-100">Dodaj rozmyślunek</button>
                   <input type="hidden" name="file" />
                   @csrf
            </form>
</div>
    <div class="col-4 p-2">
      
       <form method="post" action="{{url('admin/media/store')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
  
</form> 
    </div>  
           
            </div>
        </div>


            @csrf
            @foreach($elements as $element) 
            
                    @include('front.elements.loop.social')  
               
            @endforeach
        </div>
       
       </div>
	
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
<script> bkLib.onDomLoaded(function() {  new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul']}).panelInstance('social_element');  });</script>
<script>
Dropzone.options.dropzone =
         {
            dictDefaultMessage: 'kliknij aby dodać obrazek' ,
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
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
            }
};
</script>
@endsection