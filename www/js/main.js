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

    $('form').on('afterValidateAttribute', function(event, attribute, message){
        var input = $(attribute.input);
        var timer = setInterval(function(){
            if(attribute.status == 1){
                clearInterval(timer);
                if(input.parent().hasClass('invalid')){
                    input.removeClass('valid').addClass('invalid').parent().find('.help-block').remove();
                    if (message) {
                        input.next().attr('data-error', message);
                    }
                }else if(input.parent().hasClass('valid')){
                    input.removeClass('invalid').addClass('valid').next().removeAttr('data-error');
                }
            }
        }, 4);
    });


    var paramName = 'building_type_id';
    var propId = location.href.substr(location.href.lastIndexOf(paramName)+paramName.length+4, 1);

    $('.general-menu a').each(function(){
        var linkData = $(this).attr('href').substr(location.href.lastIndexOf(paramName)+paramName.length+4, 1);
        if($(this).attr('href').lastIndexOf(paramName) != -1 && $(this).attr('href').substr($(this).attr('href').lastIndexOf(paramName)+paramName.length+4, 1) == propId){
            $(this).parent().addClass('active');
        }
    });
});