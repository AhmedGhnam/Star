$(document).ready(function() {

    

    // make the placeholder disapear when typing in the input
    
    $('[placeholder]').focus(function() {
        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function() {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });

    // switch between forms

    $('.form-container h1 span').click(function() {

        $(this).addClass('selected').siblings().removeClass('selected');

        $('.form-container form').hide();

        $('.' + $(this).data('class')).fadeIn(100);

    });

    //Calls the selectBoxIt method on your HTML select box.
        
    $("select").selectBoxIt({
        autoWidth: false
    });


});