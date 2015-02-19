<h2>Store Contact Settings</h2>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="blogname">Enable Contact</label></th>
      <td><label for="ecc_contact_enable">
          <input name="ecc_contact_enable" type="checkbox" id="ecc_contact_enable" value="true" <?php echo (get_option('ecc_contact_enable'))?'checked=\"checked\"':"";?> >
          Enable</label>
        <p class="description">Enable Contact Info</p>
        <input name="ecc_contact_title" type="text" id="ecc_contact_title" value="<?php echo get_option('ecc_contact_title');?>" size="40" maxlength="40">
        <p class="description">Contact Info Title</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Phone</label></th>
      <td><input name="ecc_contact_phone_1" type="text" id="ecc_contact_phone_1" value="<?php echo get_option('ecc_contact_phone_1');?>" size="40" maxlength="40">
        <p class="description">Phone Number</p></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="blogname">Email</label></th>
      <td><input name="ecc_contact_email" type="text" id="ecc_contact_email" value="<?php echo get_option('ecc_contact_email');?>" size="40" maxlength="40">
        <p class="description">Email Address</p></td>
    </tr>
  </tbody>
</table>
<p class="submit">
  <input type="submit" name="submit" class="button button-primary" value="Save Changes">
</p>
