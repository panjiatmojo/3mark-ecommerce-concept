function activateImageUploader(selector) {
    var selector = (selector != undefined) ? selector : "";

    var image_custom_uploader;
	//console.log(selector + '_button');
	
    jQuery(selector + '_button').click(function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (image_custom_uploader) {
            image_custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        image_custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        image_custom_uploader.on('select', function() {
            attachment = image_custom_uploader.state().get('selection').first().toJSON();
            var url = '';
            url = attachment['url'];
			//console.log(selector);
			
            jQuery(selector).val(url);
        });

        //Open the uploader dialog
        image_custom_uploader.open();
    });
}	