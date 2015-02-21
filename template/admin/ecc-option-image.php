<?php
	wp_enqueue_script('ecc-init-image-upload', get_template_directory_uri().'/library/js/ecc-init-image-upload.js', array('jquery'), '1.0.0');
	wp_enqueue_media();
?>
<script>
jQuery(document).ready(function()
{
	activateImageUploader('#ecc_image_loader_logo');
});
</script>
<h2>Image Loader Settings</h2>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="blogname">Image Loader</label></th>
      <td><label for="ecc_image_loader_enable">
          <input name="ecc_image_loader_enable" type="checkbox" id="ecc_image_loader_enable" value="true" <?php echo (get_option('ecc_image_loader_enable'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Image Loader</p>
    </tr>
  <tr valign="top">
      <th scope="row"><label for="blogname">Image Loader Logo</label></th>
      <td><input id="ecc_image_loader_logo" type="text" size="36" name="ecc_image_loader_logo" value="<?php echo get_option('ecc_image_loader_logo');?>" />
      <input id="ecc_image_loader_logo_button" class="ecc_image_loader_logo-button" type="button" value="Upload Image" />
        <p class="description">Image Loader Logo</p></td>
    </tr>
  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
