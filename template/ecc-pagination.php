<?php
	global $previous_post_word, $next_post_word, $wp_query;
	
	$max_pages = $wp_query->max_num_pages;
	
	if(get_query_var('paged'))
	{
	$current_page = get_query_var('paged');
	}
	else if(get_query_var('page'))
	{
	$current_page = get_query_var('page');	
	}
	else
	{
	$current_page = 1;	
	}
	
	$output = '';
	
	if (is_singular()):
	    if (is_mobile()) {
	        //	if page type is singular & mobile then create simple pagination, older post, home & newer post
	        ?>
<div class="pagination-wrapper">
	<ul class="pagination simple">
		<li style="float:left;text-align:center;"><?php echo sibling_post_link('%link', $previous_post_word, $in_same_cat = false, $excluded_categories = '', $previous = false)?></li>
		<li style="margin:auto;text-align:center;"><a  class="ecc-home-link" href="<?php echo get_home_url();?>">home</a></li>
		<li style="float:left;text-align:center;"><?php echo sibling_post_link('%link', $next_post_word, $in_same_cat = false, $excluded_categories = '', $previous = true)?></li>
	</ul>
	<div class="separator"></div>
</div>
<?php
	} else {
	    //	if page type is singular & non-mobile then create simple pagination, older post, home & newer post
		?>
        
<div class="pagination-wrapper">
	<ul class="pagination simple">
		<li style="float:left;text-align:center;"><?php echo sibling_post_link('%link', $previous_post_word, $in_same_cat = false, $excluded_categories = '', $previous = false)?></li>
		<li style="text-align:center;"><a  class="ecc-home-link" href="<?php echo get_home_url();?>">HOME</a></li>
		<li style="float:left;text-align:center;"><?php echo sibling_post_link('%link', $next_post_word, $in_same_cat = false, $excluded_categories = '', $previous = true)?></li>
	</ul>
	<div class="separator"></div>
</div>
<?php
	}
	else:
	
	$category = '';
	
	if (get_query_var('cat')) {
	    $category = get_query_var('cat');
	    $category = '&cat=' . $category;
	} else if (get_query_var('s')) {
	    $category = get_query_var('s');
	    $category = '&s=' . $category;
	}
	
	if (is_mobile()) {
	$next_page = ($current_page + 1 <= $max_pages)? $current_page + 1 : $max_pages;
	$previous_page = ($current_page - 1 >= 1)? $current_page - 1 : 1;
	?>
<div class="pagination-wrapper simple">
	<ul class="pagination">
		<li><a href="?paged=1<?php echo $category;?>"> &lt;&lt; </a></li>
		<li><a href="?paged=<?php echo $previous_page . $category;?>"> &lt; </a></li>
		<li><a href="#" class="ecc-active-page"><?php echo $current_page;?></span></a></li>
		<li><a href="?paged=<?php echo $next_page . $category;?>"> &gt; </a></li>
		<li><a href="?paged=<?php echo $max_pages . $category;?>"> &gt;&gt; </a> </li>
	</ul>
</div>
<?php
	} else {
	            
	            //	if page type is not singular then create complete pagination
	?>
<div class="pagination-wrapper">
	<!--<span class="pagination-info">page <?php echo $current_page;?> of <?php echo $max_pages;?></span>-->
	<ul class="pagination">
	<?php
		$i = 1;
		
		//	if the total pages is 5, then iterate all the page and show it
		if ($max_pages <= 5):
		while ($max_pages > 0):
		$attribute = ($i == $current_page) ? 'class="ecc-active-page"' : '';
		?>
	<li><a <?php echo $attribute;?> href="?paged=<?php echo $i . $category;?>"><?php echo $i;?></a></li>
	<?php
		$i++;
		$max_pages--;
		endwhile;
		//	if the total pages is more than 5 and current page maximum 3
		elseif ($max_pages > 5 && $current_page <= 3):
		for ($i = 1; $i <= 3; $i++) {
		$attribute = ($i == $current_page) ? ' class="ecc-active-page"' : '';
		?>
	<li><a <?php echo $attribute;?> href="?paged=<?php echo $i . $category;?>"><?php echo $i;?></a></li>
	<?php
		}
		?>
	<li><a href="?&paged=4<?php echo $category;?>">4</a></li>
	<li><span>...</span></li>
	<li><a href="?&paged=<?php echo $max_pages . $category;?>"><?php echo $max_pages; ?></a></li>
	<?php
		//	if the total pages is more than 5 and current page at least max_pages-2
		elseif ($max_pages > 5 && $current_page >= ($max_pages - 2)):
		?>
	<li><a href="?paged=1<?php echo $category;?>">1</a></li>
	<li><span>...</span></li>
	<li><a href="?paged=<?php echo ($max_pages - 3) . $category;?>"><?php echo ($max_pages - 3);?></a></li>
	<?php
		for ($i = 2; $i >= 0; $i--) {
		$attribute = ($max_pages - $i == $current_page) ? ' class="ecc-active-page"' : '';
		
		?>
	<li><a <?php echo $attribute;?> href="?paged='<?php echo ($max_pages - $i) . $category ;?>"> <?php echo($max_pages - $i);?></a></li>
	<?php
		}
		//	if the total pages is more than 5 and current page > 3, then show the first, current-1, current, current +1 & last
		elseif ($max_pages > 5 && $current_page > 3):
		?>
	<ul class="pagination">
		<li><a href="?paged=1<?php echo $category;?>">1</a></li>
		<li><span>...</span></li>
		<li><a href="?paged=<?php echo ((int) $current_page - 1) . $category;?>"><?php echo ((int) $current_page - 1);?></a></li>
		<li><a class="ecc-active-page" href="?paged=<?php echo $current_page . $category;?>"><?php echo $current_page;?></a></li>
		<li><a href="?paged=<?php echo ((int) $current_page + 1) . $category;?>"><?php echo ((int) $current_page + 1);?></a></li>
		<li><span>...</span></li>
		<li><a href="?paged=<?php echo $max_pages . $category;?>"><?php echo $max_pages;?></a></li>
	</ul>
	<?php
		endif;  
		?>
	<div class="separator"></div>
</div>
<?php
	}
	endif;
	?>