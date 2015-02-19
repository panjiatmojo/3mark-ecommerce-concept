<h2>Picture Slider Settings</h2>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="blogname">Enable Slider</label></th>
      <td><label for="ecc_slider_enable">
          <input name="ecc_slider_enable" type="checkbox" id="ecc_slider_enable" value="true" <?php echo (get_option('ecc_slider_enable'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Picture Slider</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Enable Full Screen</label></th>
      <td><label for="ecc_slider_full_screen">
          <input name="ecc_slider_full_screen" type="checkbox" id="ecc_slider_full_screen" value="true" <?php echo (get_option('ecc_slider_full_screen'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Full Screen Picture Slider</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Banner Ratio</label></th>
      <td><table width="auto" border="0">
          <tr>
            <td>Width</td>
            <td><input name="ecc_slider_width_ratio" type="text" id="ecc_slider_width_ratio" value="<?php echo get_option('ecc_slider_width_ratio');?>" size="4" maxlength="4">
              px
              </label></td>
          </tr>
          <tr>
            <td>Height</td>
            <td><label for="ecc_slider_height_ratio">
                <input name="ecc_slider_height_ratio" type="text" id="ecc_slider_height_ratio" value="<?php echo get_option('ecc_slider_height_ratio');?>" size="4" maxlength="4">
                px</label></td>
          </tr>
        </table>
        <p class="description">Banner Ratio</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Slider Animation</label></th>
      <td><select name="ecc_slider_animation" type="text" id="ecc_slider_animation" >
          <option value="fade" <?php echo get_option('ecc_slider_animation') == "fade" ? "selected" : "";?>>Fade</option>
          <option value="slide" <?php echo get_option('ecc_slider_animation') == "slide" ? "selected" : "";?>>Slide</option>
        </select>
        <p class="description">Types of Slider Animation</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Slider Count</label></th>
      <td><input name="ecc_slider_count" type="text" id="ecc_slider_count" value="<?php echo get_option('ecc_slider_count');?>" size="2" maxlength="2">
        <p class="description">Number of Slides to Show</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Slider Duration</label></th>
      <td><input name="ecc_slider_duration" type="text" id="ecc_slider_duration" value="<?php echo get_option('ecc_slider_duration');?>" size="5" maxlength="5">
        <p class="description">Time Duration Between Slides</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Slider Pause</label></th>
      <td><input name="ecc_slider_pause" type="text" id="ecc_slider_pause" value="<?php echo get_option('ecc_slider_pause');?>" size="5" maxlength="5">
        <p class="description">Pause Duration for Slide</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Slider Height</label></th>
      <td><input name="ecc_slider_height" type="text" id="ecc_slider_height" value="<?php echo get_option('ecc_slider_height');?>" size="5" maxlength="5">
        <p class="description">Height of Picture Slider</p></td>
    </tr>
  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
