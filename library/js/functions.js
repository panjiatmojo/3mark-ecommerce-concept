function addPictureMargin() {
    var images = jQuery('.post-content img');

    for (var i = 0; i < images.length; i++) {
        if (parseInt(images.eq(i).attr('width'), 10) > 100) {
            images.eq(i).css('margin', '20px');
        }
    }
}

function centerPostThumbnail(container) {
    container = container || ".post-thumbnail";
    var images = jQuery(container + ' img');

    for (var i = 0; i < images.length; i++) {
        var width = parseInt(images.eq(i).css('width'), 10);
        var height = parseInt(images.eq(i).css('height'), 10);

        if (height > width) {
            var parentHeight = parseInt(images.eq(i).parent().css('height'), 10);
            var margin = -1 * (height - parentHeight) / 2;
            images.eq(i).css('margin-top', margin + 'px');
        }
    }
}

function activatePanorama() {
    var offsetBase = 20; //	offset for panorama shift after click in percentage
    var images = jQuery('.panorama-view');

    for (var i = 0; i < images.length; i++) {
        var width = parseInt(images.eq(i).css('width'), 10);
        images.eq(i).css('height', parseFloat(width * (2 / 3)));
    }

    var arrowWidth = parseInt(0.1 * width, 10);
    var arrowHeight = arrowWidth;
    var radius = parseInt(arrowWidth / 2, 10);

    var leftArrow = '<div class="panorama-view-left-arrow" style="width:' + arrowWidth + 'px;height:' + arrowHeight + 'px;border-radius:' + radius + 'px;line-height:' + arrowHeight + 'px;left:5%"></div>';
    var rightArrow = '<div class="panorama-view-right-arrow" style="width:' + arrowWidth + 'px;height:' + arrowHeight + 'px;border-radius:' + radius + 'px;line-height:' + arrowHeight + 'px;right:5%;"></div>';


    jQuery('.panorama-view').css('position', 'relative');
    jQuery('.panorama-view').append(leftArrow + rightArrow);

    jQuery('.panorama-view').click(function(e) {
        //	get the wrapper position first, compare with the mouse click position
        var wrapperOffset = jQuery(this).offset();
        var position = e.pageX - wrapperOffset.left;

        var backgroundWidth = jQuery(this).children('img').css('width');

        console.log(backgroundWidth);

        var width = parseInt(jQuery(this).width(), 10);

        var currentPosition = jQuery(this).css('background-position');
        currentPosition = currentPosition.split(' ');

        //	if dimension is in percentage then convert to pixel
        var patt = new RegExp(/%/g);

        try {
            var result = patt.test(currentPosition[0]);
        } catch (exception) {
            var result = false;
        }


        if (result) {
            currentPosition = parseFloat(currentPosition[0].replace(/%/g, ''));
            //currentPosition = (currentPosition/100)* width;
        }
        /*else
		{
			try
			{
				currentPosition = currentPosition[0].replace("px",'');	
			}
			catch(exception)
			{
				currentPosition = currentPosition[0];
			}
		}*/


        if (position < (width / 2)) {
            /*if(currentPosition > 0)
			{
				jQuery(this).css('background-position', (currentPosition - (width/2))+'px 50%' );	
			}
			else if( (currentPosition - (width/2)) < 0)
			{
				
			}*/
            if (currentPosition > 0) {
                var nextPosition = (currentPosition - offsetBase < 0) ? 0 : currentPosition - offsetBase;
                jQuery(this).css('background-position', nextPosition + '%');
            } else {
                //jQuery(this).css('background-position', 'center');
            }

        } else if (position > width / 2) {
            /*if(currentPosition < width)
			{
				jQuery(this).css('background-position', (currentPosition + (width/2))+'px 50%' );
			}
			else if( (currentPosition + (width/2)) > width)
			{
				jQuery(this).css('background-position', 'right');
			}*/

            if (currentPosition < 100) {
                var nextPosition = (currentPosition + offsetBase > 100) ? 100 : currentPosition + offsetBase;
                jQuery(this).css('background-position', nextPosition + '%');
            } else {
                //jQuery(this).css('background-position', 'center');
            }
        }

        position = 0;

    });
}

jQuery(document).ready(function($) {

	if($('.main-wrapper'))
	{
		var headerHeight = parseFloat($('.header-wrapper').height());
		$('.main-wrapper').css('margin-top', headerHeight+'px');	
	}
	
    if ($('#wpadminbar')) {
        //	function to create wpadminbar stack with header
        var height = $('#wpadminbar').outerHeight();

        $('.header-wrapper').css('margin-top', height + 'px');
    }
	
	var headerWidth = $('#header').outerWidth(true);

    $('.up-arrow').click(function() {
        //	function to scroll the screen upward
        $('html, body').animate({
            scrollTop: $("html").offset().top
        }, 200);
    });
	
	/**	activate the flexnav menu	**/	
	$(".flexnav").flexNav();
	

    $(document).ajaxComplete(function(event, xhr, settings) {
        //	function to detect any ajax call for add to cart wpec plugin

        var patt = /(&action=add_to_cart)/g;
        patt = new RegExp(patt);
        var addToCartEvent = patt.test(settings.data);

        if (addToCartEvent) {

            try {
                var response = JSON.parse(xhr.responseText);
                console.log(response['widget_output']);

                var cartCount = $(response['widget_output']).find('.cart-widget-count').text();

                cartCount = parseInt(cartCount, 10);

                var currentCartCount = $('#shopping-cart-content').html();

                //	check if new car count is larger then current cart count
                if (cartCount > currentCartCount) {
                    $('#shopping-cart-content').html(cartCount);

                }
            } catch (e) {
                console.log(e);

            }
        }

    });
});