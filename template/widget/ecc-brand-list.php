<h2>Brands</h2>
<ul>
  <?php
  global $ecc_brand;

	foreach($ecc_brand as $key => $brand_data)
	{
		?>
  <li> <a href="<?php echo get_term_link($brand_data->slug, 'brand');?>"><?php echo $brand_data->name;?>
  <?php if(get_option('ecc_enable_brand_count')):?><span>(<?php echo $brand_data->count; ?>)</span><?php endif;;?> </a></li>
  <?php
    }
	
	?>
  <div style="clear:both"></div>
</ul>	