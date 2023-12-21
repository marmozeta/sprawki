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


