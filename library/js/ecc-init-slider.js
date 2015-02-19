jQuery(document).ready(function($) {

    initSlider();

    $(window).resize(function() {
        /**	reinitialize slider everytime screen change detected	**/
        initSlider();
    });

    $(window).on("orientationchange", function() {
        /**	reinitialize slider everytime screen change detected	**/
        initSlider();
    });

    (function($) {
        "use strict";
        $(function() {
            jQuery('.flexslider').flexslider({
                animation: $('#flexslider-animation').val(),
                slideshowSpeed: $('#flexslider-pause').val(), //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationSpeed: $('#flexslider-duration').val(), //Integer: Set the speed of animations, in milliseconds
                prevText: '',
                nextText: '',
                startAt: 0,

            });
        });
    }(jQuery));



    function initSlider() {

        if ($('#slider-wrapper')) {
            if ($('#ecc-slider-full-screen').val() == "true") {
                /**	function to adjust slider view height	**/
                var screenHeight = $(window).outerHeight(true);
                var headerHeight = parseFloat($('.header-wrapper').outerHeight(true));
                var footerHeight = parseFloat($('.footer-wrapper').outerHeight(true));
                var sliderHeight = parseFloat(screenHeight) - headerHeight - footerHeight;

                $('#slider-wrapper').css('height', sliderHeight + 'px');
            } else if ($('#flexslider-height').val()) {
				
				var normalizedHeight = $('#slider-wrapper').outerWidth() * ($('#flexslider-height').val() / $('#flexslider-width').val())
				
                $('#slider-wrapper').css('height', normalizedHeight + 'px');
            }

            var sliderHeight = parseFloat($('#slider-wrapper').css('height'));

            $('.flexslider, ul.slides, ul.slides li, .flexslider-image-wrapper, .display-slider-content-wrapper').css({
                'height': sliderHeight + 'px',
                'width': '100%',
                'display': 'block',
                'overflow': 'hidden'
            });


            /**	on mobile device show full width drop down menu **/
            if ($('body').outerWidth() < 800 || true == true) {
                /**	center image for display slider on mobile	**/
                var selector = $('.display-slider-image-wrapper');

                /**	if image are ready then proceed to add additional style	**/

                selector.find('img').ready(function() {
                    calculateSliderMargin(selector);
                });
				
				/**	also provide load event detection if ready event is fail	**/
                selector.find('img').load(function() {
                    calculateSliderMargin(selector);
                });
            }
        }
    }


    function calculateSliderMargin(selector) {
        for (var i = 0; i < selector.length; i++) {
            /**	if image are ready then proceed to add additional style	**/

            var imageWrapperWidth = parseFloat(selector.eq(i).width());
            var imageWidth = parseFloat(selector.eq(i).find('img').width());

            if (imageWidth > 0) {
                var marginLeft = (-1 / 2) * (imageWidth - imageWrapperWidth);
            } else {
                var marginLeft = 0;
            }
            /**	only appy style if marginLeft is defined	**/
            if ($.isNumeric(marginLeft)) {
                selector.eq(i).find('img').css('margin-left', marginLeft + 'px');
            }
        }
    }


});