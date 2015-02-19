<script>
jQuery(document).ready(function(){
 var image_custom_uploader;
 jQuery('#ecc_partner_url_button').click(function(e) {
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
 jQuery('#ecc_partner_url').val(url);
 });

 //Open the uploader dialog
 image_custom_uploader.open();
 });
});
</script>
<?php 
wp_enqueue_media();
$image_url = (get_post_meta( $post->ID, 'ecc_partner_url', true )) ? get_post_meta( $post->ID, 'ecc_partner_url', true ) : '';
?>

<h2>Partner Settings</h2>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="blogname">Enable Partner List</label></th>
      <td><label for="ecc_partner_enable">
          <input name="ecc_partner_enable" type="checkbox" id="ecc_partner_enable" value="true" <?php echo (get_option('ecc_partner_enable'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Partner Info</p>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Default Directory</label></th>
      <td><input id="ecc_partner_url" type="text" size="36" name="ecc_partner_url" value="<?php echo $image_url;?>" />
      <input id="ecc_partner_url_button" class="button" type="button" value="Upload Image" />
        <p class="description">Default Partner's Image</p></td>
    </tr>

  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
