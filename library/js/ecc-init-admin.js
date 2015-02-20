jQuery(document).ready(function($) {
	
	initAdmin();

    function initAdmin() {
		
		$('.ecc-admin-form').submit(function()
		{

			var selector = $('input[type=checkbox]');
			
			for(var i = 0; i < selector.length; i++)
			{
				if(!selector.eq(i).attr('checked'))
				{
					var name = selector.eq(i).attr('name');
					selector.eq(i).attr('disabled', 'disabled');
					selector.eq(i).after('<input type="hidden" name="'+ name + '" value="0">');
				}
			}
		})
    }


});