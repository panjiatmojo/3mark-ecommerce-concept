<?php
	require_once('functions.php');
	require_once('functions/mobile-detect/mobile-detect.php');
	
	$word_search = get_option("3mark_word_search","Search Here");
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php /////////	head section start here ?>
	<head>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet" type="text/css" media="screen" />
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo site_url(); ?>/xmlrpc.php?rsd" />
		<?php
			//	load jquery script
			wp_enqueue_script('jquery');	
			?>
		<title>
			<?php 
				//	show the title meta
				if(defined('WPSEO_URL'))
				{ // If Using WordPress SEO Yoast - let it override
				wp_title('|');	
				}
				else
				{
				wp_title('|', TRUE, 'right');	//	the title tag defined here
				}
				?>
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
			//	check if device is mobile
			if(get_view_type() == 'mobile'):
			//	only load viewport on mobile device
			?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
			endif;
			?>
		<?php 
			//	queue the javascript here
			wp_enqueue_script('ecc-function', get_template_directory_uri().'/js/functions.js', array('jquery'), '1.0', false);	//	load the 3mark library script
			
			if (is_singular()) wp_enqueue_script('comment-reply');	//	if single page detected load the comment function
			?>
		<?php wp_head();?>
	</head>
	<body id="home" class="<?php echo get_view_type();?>">
		<div class="header-wrapper">
		<div class="header">
			<a class="banner-wrapper" href="<?php echo site_url(); ?>" style="font-style:normal;display:table;">
				<div style="display:table-cell;vertical-align:middle">
					<div>
						<h1 class="banner"><?php echo get_option('blogname','theatmojo.com');?> </h1>
						<span style="font-size:14px;vertical-align:super;"> &trade; </span> 
					</div>
					<div>
						<h2 class="banner-sub"><?php echo get_option('blogdescription','theatmojo.com');?> </h2>
					</div>
				</div>
				<div class="separator"> </div>
			</a>
			<div id="shopping-cart-wrapper">
				<?php if(!is_mobile()):?>
				<div class="search-wrapper">
					<div class="search">
						<form  action="<?php echo site_url(); ?>">
							<input type="text" placeholder="<?php echo $word_search;?>" name="s">
							<span class="search-button"></span>
						</form>
					</div>
				</div>
				<div class="contact-wrapper">
					<div style="display:table-cell;vertical-align:middle">
						<h2 class="contact"> <?php echo get_option('3mark_word_contact', 'support')?>: <a href="tel:<?php echo get_option('3mark_store_phone'); ?>"> <?php echo get_option('3mark_store_phone'); ?> </a> </h2>
					</div>
				</div>
				<?php endif;?>
				<div class="separator"> </div>
			</div>
			<a href="#">
				<div class="up-arrow"> <img src="<?php echo get_template_directory_uri();?>/images/3mark-up-arrow.png"/> </div>
			</a>
		</div>
		<?php if(!is_mobile()):
			?>
		<div class="navigation-wrapper">
			<div class="navigation-bar">
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				<div class="separator"> </div>
			</div>
		</div>
		<?php
			endif;
			?>
		<?php if(is_mobile()):?>
		<div class="search-wrapper">
			<div class="search">
				<form  action="<?php echo site_url(); ?>">
					<input type="text" placeholder="<?php echo $word_search; ?>" name="s">
					<span class="search-button"></span>
				</form>
			</div>
		</div>
		<div class="separator"> </div>
		<?php
			endif;	?>
		<?php if(is_mobile()): ?>
		<div class="contact-wrapper">
			<h2 class="contact"> <?php echo get_option('3mark_word_contact')?>: <a href="tel:<?php echo get_option('3mark_store_phone'); ?>
				"> <?php echo get_option('3mark_store_phone'); ?> </a> </h2>
		</div>
		<?php
			endif;
			?>
			
            </div>