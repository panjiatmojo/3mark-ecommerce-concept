<?php
	wp_enqueue_script('ecc-init-image-upload', get_template_directory_uri().'/library/js/ecc-init-image-upload.js', array('jquery'), '1.0.0');
	wp_enqueue_media();
?>
<script>
jQuery(document).ready(function()
{
	activateImageUploader('#ecc_website_logo');
	activateImageUploader('#ecc_website_mobile_logo');
});
</script>
<h2>General Settings</h2>
<table class="form-table">
  <tbody>
  <tr valign="top">
      <th scope="row"><label for="blogname">Website Logo</label></th>
      <td><input id="ecc_website_logo" type="text" size="36" name="ecc_website_logo" value="<?php echo get_option('ecc_website_logo');?>" />
      <input id="ecc_website_logo_button" class="button ecc-uploader-button" type="button" value="Upload Image" />
        <p class="description">Website Header Logo</p></td>
    </tr>
  <tr valign="top">
      <th scope="row"><label for="blogname">Website Mobile Logo</label></th>
      <td><input id="ecc_website_mobile_logo" type="text" size="36" name="ecc_website_mobile_logo" value="<?php echo get_option('ecc_website_mobile_logo');?>" />
      <input id="ecc_website_mobile_logo_button" class="button ecc-uploader-button" type="button" value="Upload Image" />
        <p class="description">Website Header Mobile Logo</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Latest Post</label></th>
      <td><input id="ecc_latest_post_count" type="text" size="2" name="ecc_latest_post_count" value="<?php echo get_option('ecc_latest_post_count');?>" />
        <p class="description">Latest Post Count</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Latest Product</label></th>
      <td><input id="ecc_latest_poduct_count" type="text" size="2" name="ecc_latest_poduct_count" value="<?php echo get_option('ecc_latest_poduct_count');?>" />
        <p class="description">Latest Product Count</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Excerpt Length</label></th>
      <td><input id="ecc_excerpt_length" type="text" size="2" name="ecc_excerpt_length" value="<?php echo get_option('ecc_excerpt_length');?>" />
        <p class="description">Post Excerpt Length</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Excerpt Read More</label></th>
      <td><input id="ecc_excerpt_read_more" type="text" size="2" name="ecc_excerpt_read_more" value="<?php echo get_option('ecc_excerpt_read_more');?>" />
        <p class="description">Post Excerpt Read More Symbol</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Search Result</label></th>
      <td><input id="ecc_search_result_count" type="text" size="2" name="ecc_search_result_count" value="<?php echo get_option('ecc_search_result_count');?>" />
        <p class="description">Search Result Count</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Page Loading Time</label></th>
      <td><label for="ecc_loading_time_enable">
          <input name="ecc_loading_time_enable" type="checkbox" id="ecc_loading_time_enable" value="true" <?php echo (get_option('ecc_loading_time_enable'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Page Loading Time</p>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Brand</label></th>
      <td><label for="ecc_enable_brand_count">
          <input name="ecc_enable_brand_count" type="checkbox" id="ecc_enable_brand_count" value="true" <?php echo (get_option('ecc_enable_brand_count'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Brand Product Count</p>
    </tr>

  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
