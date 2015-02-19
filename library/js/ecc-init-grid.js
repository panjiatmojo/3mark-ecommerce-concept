jQuery(document).ready(function($) {

    initGrid();

    $(window).resize(function() {
        /**	reinitialize grid everytime screen change detected	**/
        initGrid();
    });

    $(window).on("orientationchange", function() {
        /**	reinitialize grid everytime screen change detected	**/
        initGrid();
    });

    function initGrid() {

        if ($('.ecc-grid-product')) {
            /**	function to adjust the grid product image	**/
			
            var gridProductWidth = parseFloat($('.ecc-grid-product-image').width());
            var gridProductHeight = parseFloat($('.ecc-grid-product-image').height());

            var ratio = gridProductWidth / gridProductHeight;

            /**	set grid product image size into fix aspect ratio	**/
            //$('.ecc-grid-product-image').height((4 / 16) * gridProductWidth)

            var gridProductSelector = $('.ecc-grid-product img');

            for (i = 0; i < gridProductSelector.length; i++) {
                var imageHeight = parseFloat(gridProductSelector.eq(i).height());
                var imageWidth = parseFloat(gridProductSelector.eq(i).width());


                if (ratio >= (3 / 4)) {
                    /**	if ratio greater than 3:4 then set height to max	**/
                    gridProductSelector.eq(i).css({
                        'height': '100%',
                        'width': 'auto'
                    })
                } else {
                    /**	if ratio greater than 3:4 then set width to max	**/
                    gridProductSelector.eq(i).css({
                        'height': 'auto',
                        'width': '100%'
                    })
                }

            }

            $('.ecc-grid-product img').removeAttr('width');
            $('.ecc-grid-product img').removeAttr('height');
        }
    }


});