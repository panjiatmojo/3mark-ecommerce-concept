jQuery(document).ready(function($) {
	
	initAdmin();

    function initAdmin() {
		
		$('.ecc-admin-form').submit(function()
		{
			var selector = $('input[type=checkbox]');
			
			for(var i = 0; i < selector.length; i++)
			{
				/**	if check box is not checked then create hidden input with default value 0	**/
				if(!selector.eq(i).attr('checked'))
				{
					var name = selector.eq(i).attr('name');
					/**	disable the checkbox input	**/
					selector.eq(i).attr('disabled', 'disabled');
					/**	create hidden input with similar name	**/
					selector.eq(i).after('<input type="hidden" name="'+ name + '" value="0">');
				}
			}
		})
    }


});