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

new DataTable('#zero_config', {language: {
        url: '//cdn.datatables.net/plug-ins/2.0.2/i18n/pl.json',
    },});    

