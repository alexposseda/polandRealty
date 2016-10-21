$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('.tooltipped').tooltip({delay: 50});
    $('.modal-trigger').leanModal();
    $('.materialboxed').materialbox();
    if($(window).width() < 992){
        $('.nav').wrap('<div class="navbar-fixed"></div>');
    }


    $('#personal-but').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: false, // Activate on hover
            gutter: 0, // Spacing from edge
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'left' // Displays dropdown with edge aligned to the left of button
        }
    );

});