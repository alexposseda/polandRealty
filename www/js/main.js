$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('.tooltipped').tooltip({delay: 50});
    $('.modal-trigger').leanModal();
    $('.materialboxed').materialbox();
    if($(window).width() < 992){
        $('.nav').wrap('<div class="navbar-fixed"></div>');
    }
});