jQuery(document).ready(function($)
{
	var selector = $('.ecc-feed.container');
	for(var i = 0; i < selector.length; i++)
	{
		loadFeed(selector.eq(i));	
	}
	
	
	function loadFeed(selector)
	{
		var service = $(selector).find('input[name=service]').val();
		var limit = $(selector).find('input[name=limit]').val();
		var username = $(selector).find('input[name=username]').val();
		var lastDate = $(selector).find('input[name=username]').val() || 0;
		
		/**	load image url via ajax	**/
		$.ajax({
			type:'POST',
			url: global_variable.base_url + '/wp-admin/admin-ajax.php',
			data: {'action': 'ecc_update_feed','service':service,'limit':limit,'username':username,'last_date':lastDate},
			error: function()
			{
				alert('timeout');
			},
			success: function(data)
			{
				$(selector).find('ul').height(0);
				$(selector).find('ul').html(data);
				$(selector).find('ul').height('auto');
				
			}
			
			
		})
			
	}
	
});