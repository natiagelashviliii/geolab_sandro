function isEmail(email) {
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (email.search(emailRegEx) == -1) {
        return (false);
    }
    return (true);
}

function validate(e, type) {
    switch (type) {
        case 'int':
            return validateDouble(e);
            break;

        case 'double':
            return validateDouble(e, 1);
            break;

        case 'alpha':
            return validateAlpha(e);
            break;
    }
}
function validateDouble(e, _double) {
    if (!validateKeys(e, _double)) {
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

function validateAlpha(e) {
    if (!validateKeys(e)) {
        return;
    }
    // Ensure that it is a alpha and stop the keypress
    if (!(e.keyCode > 64 && e.keyCode < 91)) {
        e.preventDefault();
    }
}
function validateKeys(e, _double) {
    // Allow: backspace, delete, tab, escape and enter
    var keyCodes = [32, 57, 48, 46, 8, 9, 27, 13];
    if (_double) {
        keyCodes.push(110);
        keyCodes.push(190);
    }
    if ($.inArray(e.keyCode, keyCodes) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
        // Allow: Ctrl+9
        (e.keyCode == 57 && e.ctrlKey === true) ||
        // Allow: Ctrl+0
        (e.keyCode == 48 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return false;
    }
    return true;
}
function maxZ() {
    var maxZ = Math.max.apply(null, $.map($('body *'), function(e, n) {
        if ($(e).css('position') == 'absolute' || $(e).css('position') == 'relative' || $(e).css('position') == 'fixed')
            return parseInt($(e).css('z-index')) || 1;
    }));
    return maxZ;
}

$(document).ready(function(){
    $('select').formSelect();

    // change mode code
    $('.black-mode').on('click',function(){
        setMode();
        $('.black-mode, .mode-button').addClass('active');
        $('body').addClass('night-mode');
        $('.night, .white-mode').removeClass('active');
        $('.responsive-menu').removeClass('active');
    });
    $('.white-mode').on('click',function(){
        setMode();
        $('.black-mode, .mode-button').removeClass('active');
        $('.white-mode, .night').addClass('active');
        $('body').removeClass('night-mode');
        $('.responsive-menu').removeClass('active');
    });
    $('.mode-button').on('click',function(){
        $('.responsive-menu').removeClass('active');
        if($('.white-mode').hasClass('active')){
            $('.black-mode, .mode-button').addClass('active');
            $('body').addClass('night-mode');
            $('.night, .white-mode').removeClass('active');
        } else {
            $('.black-mode, .mode-button').removeClass('active');
            $('body').removeClass('night-mode');
            $('.night, .white-mode').addClass('active');            
        }
    });

    function setMode() {
        let mode = ($('.night').hasClass('active')) ? 'black' : 'white' ;
        console.log(mode);
        $.post('home/changemode', {'mode': mode}, function(resp) {
            console.log(resp);
        });
    }

    // slashes between social links
    $('.socials li + li').prepend('/');

    // materialize tabs
    $('.tabs').tabs({
        swipeable : true,
        responsiveThreshold : Infinity
    });
    $('.tabs-content.carousel.carousel-slider').css("height","auto");


    // popup height function
    function popupHeight(){
        if($(window).width() > 600){
            setTimeout(function(){
                $('.popup-content .text').css('height',$('.popup-content .image-block').height() - 120);
            },500);
        }
    }
    popupHeight();
    $(window).on('resize', function(){
        popupHeight();      
    });

    $('.each-work .image').on('click',function(){
        $('.popup-content').addClass('active');
    })
    $('.popup-content .close').on('click',function(){
        $('.popup-content').removeClass('active');
    })

    var animateHTML = function() {
        var elems;
        var windowHeight;
        function init() {
            elems = document.querySelectorAll('.hidden');
            windowHeight = window.innerHeight;
            addEventHandlers();
            checkPosition();
        }
        function addEventHandlers() {
            window.addEventListener('scroll', checkPosition);
            window.addEventListener('resize', init);
        }
        function checkPosition() {
            for (var i = 0; i < elems.length; i++) {
                var positionFromTop = elems[i].getBoundingClientRect().top;
                if (positionFromTop - windowHeight <= 0) {
                    elems[i].className = elems[i].className.replace(
                    'hidden',
                    'fade-in-element'
                    );
                }
            }
        }
        return {
            init: init
        };
    };
    animateHTML().init();

    $('.burger-bar').on('click', function(){
        $('.responsive-menu').addClass('active')
    });
    $('.responsive-menu .close').on('click', function(){
        $('.responsive-menu').removeClass('active')
    })
});