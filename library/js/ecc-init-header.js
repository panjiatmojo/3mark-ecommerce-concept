jQuery(document).ready(function($) {

    initHeader();

    $(window).resize(function() {
        /**	reinitialize grid everytime screen change detected	**/
        initHeader();
    });

    $(window).on("orientationchange", function() {
        /**	reinitialize grid everytime screen change detected	**/
        initHeader();
    });

    function initHeader() {

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

    }


});