jQuery(document).ready(function($)
{
	var selector = $('.ecc-image-loader');
	for(var i = 0; i < selector.length; i++)
	{
		loadImage(selector.eq(i));	
	}
	
	
	function loadImage(selector)
	{
		/**	if image-src attribute is not available then quit function	**/
		if(!$(selector).attr('image-src'))
		{
			return;	
		}
		
		var wrapperSize = 0;
		var pictureSize = 0;
		
		/**	check picture size and assign 0 if not available	**/
		pictureSize = $(selector).attr('width') || 0;
		/**	check wrapper size and assign 0 if not available	**/
		wrapperSize = $(selector).parent().outerWidth() || 0;
		
		/**	check which size is smaller (ignore 0 size)	**/
		if((pictureSize == 0 || wrapperSize < pictureSize) & wrapperSize > 0)
		{
			finalSize = wrapperSize;	
		}
		else if((wrapperSize == 0 || wrapperSize > pictureSize) & pictureSize > 0)
		{
			finalSize = pictureSize;	
		}
		else
		{
			/**	if both sizes not available then use body size	**/
			finalSize = $('body').outerWidth();	
		}
				
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
		/**	pick initial size ridiculously large	**/
		startSize.width = 20000;
		startSize.height = 20000;
			
		availableSize = availableSize.split(';');
		
		/**	find the fittest size, smallest larger than wrapper size	**/
		for(var i = 0; i < availableSize.length; i++)
		{
			var value = availableSize[i].split('x');
			
			/**	if larger than wrapper size	**/
			if(finalSize <= parseFloat(value[0]))
			{
				/**	if larger than start size	**/
				if(parseFloat(value[0]) < startSize.width)
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
			type:'POST',
			url: 'http://tokokompu.com/kontainerbags.com' + '/wp-admin/admin-ajax.php',
			data: {'action': 'ecc_image_loader','url':imageSource,'size':startSize.width},
			error: function()
			{
				var currentClass = $(selector).attr('class');
				var cleanClass = currentClass.replace(/(ecc-image-loader)/i, '');
				$(selector).attr('src', $(selector).attr('image-src'));								
				
				/**	remove image loader class	**/
				$(selector).attr('class', cleanClass);
			},
			success: function(data)
			{
				try
				{
					jsonString = data.match(/\{.*\}/i);
					jsonString = jsonString[0];
					
					json = JSON.parse(jsonString);
				}
				catch(exception)
				{
					/**	if no url sent back then use original image	**/
					var currentClass = $(selector).attr('class');
					var cleanClass = currentClass.replace(/(ecc-image-loader)/i, '');
					$(selector).attr('src', $(selector).attr('image-src'));								
					
					/**	remove image loader class	**/
					$(selector).attr('class', cleanClass);
					return;	
				}
				
				var currentClass = $(selector).attr('class');
				var cleanClass = currentClass.replace(/(ecc-image-loader)/i, '');
				
				/**	remove image loader class	**/
				$(selector).attr('class', cleanClass);
				
				/**	replace image loading symbol with real image soruce	**/			
				$(selector).attr('src', json.url);
			}
			
			
		})
			
	}
	
});