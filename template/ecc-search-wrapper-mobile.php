<?php if(is_mobile()):?>

<div class="search-wrapper">
  <div class="search">
    <form  action="<?php echo site_url(); ?>">
      <input  style="display:none" type="text" placeholder="<?php echo $word_search; ?>" name="s">
      <span class="search-button">Search</span>
    </form>
  </div>
</div>
<div class="separator"> </div>
<?php endif;?>
<?php if(is_mobile()): ?>
<div class="contact-wrapper">
  <h2 class="contact"> <?php echo get_option('3mark_word_contact')?>: <a href="tel:<?php echo get_option('3mark_store_phone');?>"> <?php echo get_option('3mark_store_phone'); ?> </a> </h2>
</div>
<?php endif;?>
