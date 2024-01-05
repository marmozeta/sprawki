$(function () {
    "use strict"; 
    $('.attribute').on('click', function() {
        if($(this).is(':checked')) $(this).parent().parent().find('.required').removeClass('d-none');
        else $(this).parent().parent().find('.required').addClass('d-none');
    });

    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=tags]');
    // initialize Tagify on the above input node reference
    new Tagify(input)
});

function showHidePassword() {
    var actual_type = $('input[name="password"]').attr('type');
    var new_type = (actual_type === 'text') ? 'password' : 'text';
    $('input[name="password"]').attr('type', new_type);
    if(new_type === 'password') $('i.fa-eye').removeClass('fa-eye').addClass('fa-eye-slash');
    else $('i.fa-eye-slash').removeClass('fa-eye-slash').addClass('fa-eye');
}

function generatePassword() {
    if (parseInt(navigator.appVersion) <= 3) {
        alert("Sorry this only works in 4.0+ browsers");
        return true;
    }
    var length=10;
    var sPassword = "";
    var noPunction = true;
    var randomLength = false;
    if (randomLength) {
        length = Math.random();
        length = parseInt(length * 100);
        length = (length % 7) + 6
    }
    for (i=0; i < length; i++) {
        numI = getRandomNum();
        if (noPunction) { while (checkPunc(numI)) { numI = getRandomNum(); } }
        sPassword = sPassword + String.fromCharCode(numI);
    }
    $('input[name="password"]').val(sPassword);
    $('input[name="confirm_password"]').val(sPassword);
    return true;
}
function getRandomNum() {
    // between 0 - 1
    var rndNum = Math.random()
    // rndNum from 0 - 1000
    rndNum = parseInt(rndNum * 1000);
    // rndNum from 33 - 127
    rndNum = (rndNum % 94) + 33;
    return rndNum;
}
function checkPunc(num) {
    if ((num >=33) && (num <=47)) { return true; }
    if ((num >=58) && (num <=64)) { return true; }
    if ((num >=91) && (num <=96)) { return true; }
    if ((num >=123) && (num <=126)) { return true; }
    return false;
}


// vars
let result = document.querySelector('.result'),
img_result = document.querySelector('.img-result'),
img_h = document.querySelector('.img-h'),
options = document.querySelector('.options'),
save = document.querySelector('.save'),
cropped = document.querySelector('.cropped'),
dwn = document.querySelector('.download'),
upload = document.querySelector('#file-input'),
cropper = '';

// on change show image with crop options
upload.addEventListener('change', (e) => {
  if (e.target.files.length) {
		// start file reader
    const reader = new FileReader();
    reader.onload = (e)=> {
      if(e.target.result){
				// create new image
				let img = document.createElement('img');
				img.id = 'image';
				img.src = e.target.result
				// clean result before
				result.innerHTML = '';
				// append new image
        result.appendChild(img);
				// show save btn and options
				save.classList.remove('d-none');
				options.classList.remove('d-none');
				// init cropper
				cropper = new Cropper(img);
                                cropper.setAspectRatio(1.5);
      }
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

// save on click
save.addEventListener('click',(e)=>{
  e.preventDefault();
  // get result to data uri
  let imgSrc = cropper.getCroppedCanvas({
		width: 1800,
                height: 1200
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
});

