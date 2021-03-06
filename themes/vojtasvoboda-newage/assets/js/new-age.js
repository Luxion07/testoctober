(function($) {
    "use strict"; // Start of use strict


    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 100
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function () {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 50
        }
    });

    //   ============================        jquery slider            =============================

    $('.carousel').on('slid.bs.carousel', function () {

        var carouselData = $(this).data('bs.carousel');

        var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
        var total = carouselData.$items.length;


        var text = (currentIndex + 1) + " of " + total;


        $('#carousel-index').text(text);
        $('#carousel-index1').text(text);

    });
    //   ============================        jquery slider            =============================

    if (screen.width > 768  ) {
        // $(document).ready(function () {
        //
        //
        //     $('#mainNav').css('position', 'relative');
        //     $('#mainNav').clone().prependTo($('#menu'));
        //     $('#mainNav').remove();
        //
        //     // jQuery for page scrolling feature - requires jQuery Easing plugin
        //     $('a.page-scroll').bind('click', function (event) {
        //         var $anchor = $(this);
        //         $('html, body').stop().animate({
        //             scrollTop: ($($anchor.attr('href')).offset().top - 50)
        //         }, 1250, 'easeInOutExpo');
        //         event.preventDefault();
        //     });
        //
        //     var sections = $('#page-top').children('.section, footer, header');
        //     var sec = [];
        //
        //     var flag = [];
        //
        //     for (var i = 0; i < sections.length; i++) {
        //         sec[i + 1] = $(sections).eq(i);
        //         flag[i + 1] = true;
        //     }
        //
        //
        //     function GetSecsHeight(count, secs) {
        //         var result = 0;
        //         for (var i = 0; i < count; i++)
        //             result += $(secs[i + 1]).height();
        //         return result;
        //     }
        //
        //
        //     $(window).scroll(function (event) {
        //
        //         var window_height = $(window).scrollTop() + window.innerHeight;
        //
        //         var top_sections = $(sec[2]).height() + $(sec[1]).height();
        //
        //
        //         if (window_height < top_sections)
        //             flag[1] = true;
        //
        //
        //
        //
        //         if (window_height > GetSecsHeight(2, sec) && flag[1])
        //         var inter = setInterval(function () {
        //
        //             if ($(window).scrollTop() >= GetSecsHeight(2, sec)) {
        //                 clearInterval(inter);
        //                 $(sec[2]).css('position', 'relative').css('top', 0);
        //                 $(sec[1]).css('position', 'relative').css('top', 0);
        //                 flag[1] = false;
        //             }
        //             else {
        //                 $('#mainNav').css('position', 'relative');
        //                 $(window).scrollTop($(window).scrollTop() + 1);
        //                 $(sec[2]).css('position', 'relative').css('top', (+$(sec[2]).css('position', 'relative').css('top').replace('px', '') + 1) + 'px');
        //                 $(sec[1]).css('position', 'relative').css('top', (+$(sec[2]).css('position', 'relative').css('top').replace('px', '') + 1) + 'px');
        //             }
        //         }, 30);
        //
        //
        //         if ($(window).scrollTop() > top_sections)
        //             $('#mainNav').css('position', 'fixed');
        //         else
        //             $('#mainNav').css('position', 'relative');
        //
        //
        //     });


        // });


        //   ============================        jquery scrollify            =============================


        //     $(function () {
        //         $.scrollify({
        //             section: "section",
        //         });
        //     });
        //




    $(document).ready(function(){

        var a = parseInt($('#intro').css('height'),10);
        var b = parseInt($('#download').css('height'),10);
        var c = parseInt($('.header-oi').css('height'),10);
        var d = a+b+c;
        console.log(d);
        var options = {
            offset: d,
            //offsetSide: 'bottom'

            // offset: 500
        };
        var header = new Headhesive('.header-oi', options);




        var
            firstSection      = $('#intro'),
            secondSection     = $('#download'),
            thirdSection      = $('#menu'),
            fourthSection     = $('#gallery'),
            fiveSection       = $('#reviews'),
            sixSection        = $('#instagram'),
            sevenSection      = $('#booking');




        // var fullpage =
            $('#page-top').fullpage({
            anchors:['first-section', 'second-section', 'third-section', 'fourth-section', 'five-section', 'six-section', 'seven-section'],

            scrollingSpeed: 3000,
            menu: '#mainNav',

            normalScrollElements: '#menu',
            bigSectionsDestination: top,
            easing: 'easeInOutCubic',
            loopBottom: true,
            hybrid: true,
            fitToSection: false,
            afterLoad: function(anchorLink, index){
                var loadedSection = $(this);

                // console.log(header);
                console.log('Zashel');
                console.log(arguments);
                //using anchorLink
                //   if(index != 1 && index !=2 ){
                //       header.stick();
                //   }

                if(index == 3){
                    $('#download')
                        .css('position', 'relative')
                        .css('z-index', 0);
                    $('#menu')
                        .css('margin-top', '0')
                        .css('z-index', 0);

                    var $el = $('#gallery');  //record the elem so you don't crawl the DOM everytime
                    var bottom = $el.position().top;
                    var inter = setInterval(function () {
                        //
                        if (window.scrollY >= ($('#gallery').position().top - window.innerHeight)) {
                            clearInterval(inter);
                            $.fn.fullpage.moveSectionDown();
                        }
                    }, 30);
                }


            },
            onLeave: function (index, nextIndex, direction) {
                console.log('Pokinul');
                console.log(arguments);

                if(index == 2 && nextIndex == 3 && direction == 'down'){

                    $('#menu')
                        .css('margin-top', secondSection.css('height'))
                        .css('z-index', 101);
                    $('#download')
                        .css('position', 'fixed')
                        .css('top', 0)
                        .css('z-index', 100);



                    //  $('#download').css('position', 'absolute');
                    // $('#menu').css('margin-top', '683px');

                    // $('#download').css('display', 'block');
                    // $('#download').slideToggle(3000);


                   // setFitToSection(false);


                }

                if(index == 4 && nextIndex == 3 && direction == 'up'){
                    $('#menu').css('margin-top', '0');
                }
            }

        });

    });
    }

})

(jQuery); // End of use strict




