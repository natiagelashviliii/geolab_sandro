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



    // $('.each-work .image').on('click',function(){

    //     $('.popup-content').addClass('active');

    // })

    // $('.popup-content .close').on('click',function(){

    //     $('.popup-content').removeClass('active');

    // })



    // var animateHTML = function() {

    //     var elems;

    //     var windowHeight;

    //     function init() {

    //         elems = document.querySelectorAll('.hidden');

    //         windowHeight = window.innerHeight;

    //         addEventHandlers();

    //         checkPosition();

    //     }

    //     function addEventHandlers() {

    //         window.addEventListener('scroll', checkPosition);

    //         window.addEventListener('resize', init);

    //     }

    //     function checkPosition() {

    //         for (var i = 0; i < elems.length; i++) {

    //             var positionFromTop = elems[i].getBoundingClientRect().top;

    //             if (positionFromTop - windowHeight <= 0) {

    //                 elems[i].className = elems[i].className.replace(

    //                 'hidden',

    //                 'fade-in-element'

    //                 );

    //             }

    //         }

    //     }

    //     return {

    //         init: init

    //     };

    // };

    // animateHTML().init();



    $('.burger-bar').on('click', function(){

        $('.responsive-menu').addClass('active')

    });

    $('.responsive-menu .close').on('click', function(){

        $('.responsive-menu').removeClass('active')

    });





    // Lazy load

    $(window).scroll(function() {

        if ($(window).scrollTop() + $(window).height() > $(document).height() - 10) {

            if (!projects.loadTime) { 

                projects.load();

            }

        }

    });

});





var projects = {

    offset: 0,

    loadTime: false,

    slug: null,

    project: null,



    show: function(id, slugId = null){
        var params = slugId ? {'id': id, 'slugId': slugId} : {'id': id, 'slugId': 0} ;
        $.post('/works/getProject', params, function(resp){
            if (resp) {
                $('.wokrs-container').after(resp);
                setTimeout(function() {popup.open()}, 100);
            }            
        });
    },
    load: function() {
        if ($('#filter-menu').find('a.active').data('slug')) {
            projects.slug = $('#filter-menu').find('a.active').data('slug');
        }

        projects.offset += 6;
     

        if (!projects.loadTime) { 
            projects.loadTime = true;
            projects.addLoad();
            $.post('/works/loadProjects', {'offset': projects.offset, 'slug': projects.slug}, function(resp){
                if (resp) {
                    $('#illustrations-container').append(resp);
                    projects.loadTime = false;
                } 
                projects.removeLoad();
            });
        }    
    },
    addLoad: function() {
        $("#illustrations").append('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
    },
    removeLoad: function(){
        $('.spinner').remove();
    },

    next: function(obj, slugId = null) {
        var workID = $(obj).data('id');
        var params = slugId ? {'id': workID, 'slugId': slugId} : {'id': workID, 'slugId': 0} ;
        if (workID) {
            popup.swipeLeft();
            setTimeout(function(){
                $.post('/works/getProjectContent', params, function(resp){
                    if (resp) {
                        $('.project-popup-container').append(resp);
                        $('.popup-inside:not(.current)').addClass('new next');
                        projects.initialArrows(workID, slugId);
                        popup.show();
                    }            
                });
            },500);
        }
        return false;
    },

    previous: function(obj, slugId = null){

        var workID = $(obj).data('id');
        var params = slugId ? {'id': workID, 'slugId': slugId} : {'id': workID, 'slugId': 0} ;

        if (workID) {
            popup.swipeRight();
            setTimeout(function(){
                $.post('/works/getProjectContent', params, function(resp){
                    if (resp) {
                        $('.project-popup-container').append(resp);
                        $('.popup-inside:not(.current)').addClass('new previous');
                        projects.initialArrows(workID, slugId);
                        popup.show();
                    }            
                });
            },500);
        }
        return false;
    },



    initialArrows: function(workID, slugId = null){
        var params = slugId ? {'id': workID, 'slugId': slugId} : {'id': workID, 'slugId': 0} ;
        $.post('/works/getSiblingProjects', params, function(resp){
            if (resp) {
                data = JSON.parse(resp);
                $('.arrow.left').data('id', data.previous);
                $('.arrow.right').data('id', data.next);
            }            
        });
    }

}





var popup = {

    init: function(){

        $('.popup-content .close').on('click',function(){

            $('.popup-content').removeClass('active');

            setTimeout(function() {$('.popup-content').remove()}, 500);

        })

    },



    open: function() {

        $('.popup-content').addClass('active');

        $('.popup-inside').addClass('current');

        popup.init();

    },



    close: function() {

        $('.popup-content').removeClass('active');

    },



    swipeLeft: function(){

        $('.popup-inside.current').animate({  opacity: 0 }, {

            step: function(now,fx) { $(this).css('transform','translateX(-120%)'); }, 

            duration: 'slow',

            complete: function() {

              $(this).remove();

              // popup.show();

            }

        }, 'linear');



    },



    swipeRight: function(){

        $('.popup-inside.current').animate({  opacity: 0 }, {

        step: function(now,fx) {

          $(this).css('transform','translateX(120%)');  

        }, 

        duration: 'slow',

        complete: function() {

          $(this).remove();

          // popup.show();

        }

        }, 'linear');

    },



    show: function(){

        $('.popup-inside.new').animate({ opacity: 1 }, {

            step: function(now,fx) {

              $(this).css('transform','translateX(0)');  

            },

            duration:'slow',

            complete: function(){

                $(this).removeClass('new next previous').addClass('current');

            }

        },'linear');

    }

}



AOS.init();