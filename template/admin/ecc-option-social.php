<h2>Social Media Settings</h2>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="blogname">Social Media</label></th>
      <td><label for="ecc_social_enable">
          <input name="ecc_social_enable" type="checkbox" id="ecc_social_enable" value="true" <?php echo (get_option('ecc_social_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Social Media</p>
        <input name="ecc_social_title" type="text" id="ecc_social_title" value="<?php echo get_option('ecc_social_title');?>" size="40" maxlength="40">
        <p class="description">Social Media Title</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Facebook</label></th>
      <td><label for="ecc_facebook_enable">
          <input name="ecc_facebook_enable" type="checkbox" id="ecc_facebook_enable" value="true" <?php echo (get_option('ecc_facebook_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Facebook Link</p>
        <input name="ecc_facebook_url" type="text" id="ecc_facebook_url" value="<?php echo get_option('ecc_facebook_url');?>" size="40" maxlength="40">
        <p class="description">Complete Facebook URL</p>
         <input name="ecc_facebook_name" type="text" id="ecc_facebook_name" value="<?php echo get_option('ecc_facebook_name');?>" size="40" maxlength="40">
        <p class="description">Facebook Name (e.g. https://facebook.com/yourName)</p>
        <input name="ecc_facebook_feed" type="text" id="ecc_facebook_feed" value="<?php echo get_option('ecc_facebook_feed');?>" size="40" maxlength="40">
        <p class="description">Facebook Feed Length</p>
        <input name="ecc_facebook_update" type="text" id="ecc_facebook_update" value="<?php echo get_option('ecc_facebook_update');?>" size="40" maxlength="40">
        <p class="description">Facebook Feed Update Interval</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Twitter</label></th>
      <td><label for="ecc_twitter_enable">
          <input name="ecc_twitter_enable" type="checkbox" id="ecc_twitter_enable" value="true" <?php echo (get_option('ecc_twitter_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Twitter Link</p>
        <input name="ecc_twitter_url" type="text" id="ecc_twitter_url" value="<?php echo get_option('ecc_twitter_url');?>" size="40" maxlength="40">
        <p class="description">Complete Twitter URL</p>
        <input name="ecc_twitter_name" type="text" id="ecc_twitter_name" value="<?php echo get_option('ecc_twitter_name');?>" size="40" maxlength="40">
        <p class="description">Twitter Name (e.g. https://twitter.com/yourName)</p>
        <input name="ecc_twitter_feed" type="text" id="ecc_twitter_feed" value="<?php echo get_option('ecc_twitter_feed');?>" size="40" maxlength="40">
        <p class="description">Twitter Feed Length</p>
        <input name="ecc_twitter_update" type="text" id="ecc_twitter_update" value="<?php echo get_option('ecc_twitter_update');?>" size="40" maxlength="40">
        <p class="description">Twitter Feed Update Interval</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Google+</label></th>
      <td>
        <label for="ecc_google_enable">
          <input name="ecc_google_enable" type="checkbox" id="ecc_google_enable" value="true" <?php echo (get_option('ecc_google_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Google+ Link</p>
        <input name="ecc_google_url" type="text" id="ecc_google_url" value="<?php echo get_option('ecc_google_url');?>" size="40" maxlength="40">
        <p class="description">Complete Google+ URL</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Pinterest</label></th>
      <td><label for="ecc_pinterest_enable">
          <input name="ecc_pinterest_enable" type="checkbox" id="ecc_pinterest_enable" value="true" <?php echo (get_option('ecc_pinterest_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Pinterest Link</p>
        <input name="ecc_pinterest_url" type="text" id="ecc_pinterest_url" value="<?php echo get_option('ecc_pinterest_url');?>" size="40" maxlength="40">
        <p class="description">Complete Pinterest URL</p>
        <input name="ecc_pinterest_name" type="text" id="ecc_pinterest_name" value="<?php echo get_option('ecc_pinterest_name');?>" size="40" maxlength="40">
        <p class="description">Pinterest Name (e.g. https://pinterest.com/yourName)</p>
        <input name="ecc_pinterest_feed" type="text" id="ecc_pinterest_feed" value="<?php echo get_option('ecc_pinterest_feed');?>" size="40" maxlength="40">
        <p class="description">Pinterest Feed Length</p>
        <input name="ecc_pinterest_update" type="text" id="ecc_pinterest_update" value="<?php echo get_option('ecc_pinterest_update');?>" size="40" maxlength="40">
        <p class="description">Pinterest Feed Update Interval</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Tumblr</label></th>
      <td><label for="ecc_tumblr_enable">
          <input name="ecc_tumblr_enable" type="checkbox" id="ecc_tumblr_enable" value="true" <?php echo (get_option('ecc_tumblr_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Tumblr Link</p>
        <input name="ecc_tumblr_url" type="text" id="ecc_tumblr_url" value="<?php echo get_option('ecc_tumblr_url');?>" size="40" maxlength="40">
        <p class="description">Complete Tumblr URL</p>
        <input name="ecc_tumblr_name" type="text" id="ecc_tumblr_name" value="<?php echo get_option('ecc_tumblr_name');?>" size="40" maxlength="40">
        <p class="description">Tumblr Name (e.g. https://yourName.tumblr.com/)</p>
        <input name="ecc_tumblr_feed" type="text" id="ecc_tumblr_feed" value="<?php echo get_option('ecc_tumblr_feed');?>" size="40" maxlength="40">
        <p class="description">Tumblr Feed Length</p>
        <input name="ecc_tumblr_update" type="text" id="ecc_tumblr_update" value="<?php echo get_option('ecc_tumblr_update');?>" size="40" maxlength="40">
        <p class="description">Tumblr Feed Update Interval</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Instagram</label></th>
      <td><label for="ecc_instagram_enable">
          <input name="ecc_instagram_enable" type="checkbox" id="ecc_instagram_enable" value="true" <?php echo (get_option('ecc_instagram_enable') == true)?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Instagram Link</p>
        <input name="ecc_instagram_url" type="text" id="ecc_instagram_url" value="<?php echo get_option('ecc_instagram_url');?>" size="40" maxlength="40">
        <p class="description">Complete Instagram URL</p>
        <input name="ecc_instagram_name" type="text" id="ecc_instagram_name" value="<?php echo get_option('ecc_instagram_name');?>" size="40" maxlength="40">
        <p class="description">Instagram Name (e.g. https://instagram.com/yourName)</p>
        <input name="ecc_instagram_feed" type="text" id="ecc_instagram_feed" value="<?php echo get_option('ecc_instagram_feed');?>" size="40" maxlength="40">
        <p class="description">Instagram Feed Length</p>
        <input name="ecc_instagram_update" type="text" id="ecc_instagram_update" value="<?php echo get_option('ecc_instagram_update');?>" size="40" maxlength="40">
        <p class="description">Instagram Feed Update Interval</p></td>
    </tr>
  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
