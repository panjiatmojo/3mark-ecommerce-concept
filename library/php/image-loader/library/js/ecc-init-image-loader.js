jQuery(document).ready(function($)
{
	var selector = $('.ecc-image-loader');
	for(var i = 0; i < selector.length; i++)
	{
		loadImage(selector.eq(i));	
	}
	
	
	function loadImage(selector)
	{
		if(!$(selector).attr('image-src'))
		{
			return;	
		}
		
		var wrapperSize = $(selector).parent().outerWidth();
		var availableSize = $(selector).attr('image-size');
		
		/**	get the target image source	**/
		var imageSource = $(selector).attr('image-src');
		
		/**	get the image extension	**/
		var imageExtension = imageSource.match(/([a-zA-Z0-9]*)$/g);
		
		imageExtension = imageExtension[0];
		/**	remove extension from image source	**/
		imageSource = imageSource.replace(/(\.[a-zA-Z0-9]{0,})$/gi, "");
		/**	remove size info from image source	**/
		imageSource = imageSource.replace(/(\-[0-9]x[0-9])$/gi, "");
		
		var startSize = {};
		startSize.width = 0;
		startSize.height = 0;
		
		availableSize = availableSize.split(';');
		
		/**	find the fittest size	**/
		for(var i = 0; i < availableSize.length; i++)
		{
			var value = availableSize[i].split('x');
			
			/**	if larger than wrapper size	**/
			if(wrapperSize <= parseFloat(value[0]))
			{
				/**	if larger than start size	**/
				if(parseFloat(value[0]) > startSize.width)
				{
					startSize.width = parseFloat(value[0]);
					startSize.height = parseFloat(value[1]);
				}

			}
		}
		
		/**	create target image url based on most fit size	**/
		var imageUrl = imageSource+'-'+startSize.width+'x'+startSize.height+'.'+imageExtension;
		
		/**	load image url via ajax	**/
		$.ajax({
			type:'GET',
			url:imageUrl,
			error: function()
			{
				var currentClass = $(selector).attr('class');
				var cleanClass = currentClass.replace(/(ecc-image-loader)/i, '');
				$(selector).attr('src', $(selector).attr('image-src'));								
				
				/**	remove image loader class	**/
				$(selector).attr('class', cleanClass);
			},
			success: function()
			{
				var currentClass = $(selector).attr('class');
				console.log(currentClass);
				var cleanClass = currentClass.replace(/(ecc-image-loader)/i, '');
				console.log(cleanClass);
				
				/**	remove image loader class	**/
				$(selector).attr('class', cleanClass);
				
				/**	replace image loading symbol with real image soruce	**/			
				$(selector).attr('src', imageUrl);
			}
			
			
		})	
	}
	
});