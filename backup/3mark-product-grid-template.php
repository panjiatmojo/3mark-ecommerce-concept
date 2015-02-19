    <?php /** start the product loop here */
	global $wp_query, $post, $emark_product_grid_array;
		
	?>
    <?php while (wpsc_have_products()) :  wpsc_the_product(); 
	
	//var_dump($post);
	
	// to show post title, there's some bug related to native method wpsc_the_product_title in wpsc, using $post->post_title instead
	?>
    <div class="default_product_display product_view_<?php echo wpsc_the_product_id(); ?> <?php //echo wpsc_category_class(); ?> group">
      <?php if(wpsc_show_thumbnails()) :?>
      <div class="imagecol" style="width:<?php echo $image_width; ?>px;" id="imagecol_<?php echo wpsc_the_product_id(); ?>">
        <?php if(wpsc_the_product_thumbnail()) :
						?>
        <a rel="<?php echo  $post->post_title; ?>" class="<?php //echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"> <img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo  $post->post_title; ?>" title="<?php echo  $post->post_title; ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
        <h3 class="view-detail"><?php echo get_option('3mark_word_detail','Detail')?></h3>
        </a>
        <?php else: ?>
        <a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"> <img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php esc_attr_e( 'No Image', 'wpsc' ); ?>" title="<?php echo  $post->post_title; ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" /> </a>
        <?php endif; ?>
        <?php
						if(gold_cart_display_gallery()) :
							echo gold_shpcrt_display_gallery(wpsc_the_product_id(), true);
						endif;
						?>
      <?php if(wpsc_product_on_special()) : ?>
      <h3 class="sale"><?php _e('Sale', 'wpsc'); ?></h3>
      <?php endif; ?>
      
      </div>
      <!--close imagecol-->
      <?php endif; ?>
      <h2 class="prodtitle entry-title">
        <?php if(get_option('hide_name_link') == 1) : ?>
        <?php echo  $post->post_title; ?>
        <?php else: ?>
        <a class="wpsc_product_title" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>"><?php echo  $post->post_title; ?></a>
        <?php endif; ?>
      </h2>
      <div class="productcol" <?php /**style="margin-left:<?php echo $image_width + 20; ?>px;" **/ ?> >
        <?php
							do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post);
							do_action('wpsc_product_addons', wpsc_the_product_id());
						?>
        <div class="wpsc_description">
          <?php //echo wpsc_the_product_description(); ?>
        </div>
        <!--close wpsc_description-->
        
        <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
        <?php $action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
        <?php else: ?>
        <?php $action = wpsc_this_page_url(); ?>
        <?php endif; ?>
        <form class="product_form"  enctype="multipart/form-data" action="<?php echo esc_url( $action ); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
          <?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
          <?php /** the variation group HTML and loop */?>

          <?php if (wpsc_have_variation_groups()) :
		  
		  /** disable the variation form in products page **/ ?>
          
          <?php endif; ?>


          <?php /** the variation group HTML and loop ends here */?>
          
          <?php
		  /** THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS **/
		   if(wpsc_has_multi_adding()): 
		   
		   /** disable the multi add in products page **/
		   ?>
          <?php endif ;?>
          
          <div class="wpsc_product_price">
            <?php emark_show_price(array(
			'output_you_save'=> false, //	remove the "you save" wording
			'price_text'=> '%s',	//	remove the "price" wording
			'old_price_text' => '%s'	//	remove the old price wording
			)); ?>
            
            
            <?php 
			/**	stock availability **/
			/** disable the stock availability 
			if( wpsc_show_stock_availability() ): ?>
            <?php if(wpsc_product_has_stock()) : ?>
            <div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock">
              <?php _e(get_option('3mark_word_product_in_stock',"Product in Stock"), 'wpsc'); ?>
            </div>
            <?php else: ?>
            <div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock">
              <?php _e(get_option('3mark_word_product_not_in_stock',"Product not in Stock"), 'wpsc'); ?>
            </div>
            <?php endif; ?>
            <?php endif; 
			
			**/
			?>

            <?php 
			if(wpsc_product_is_donation()) : 
			/** disable the donation in products page **/
			?>
            <?php else : ?>
            
            <?php 
			/** multi currency code **/
			if(wpsc_product_has_multicurrency()) : ?>
            <?php /**
			disable the multicurrency Mode
			echo wpsc_display_product_multicurrency(); 
			**/
			?>
            <?php endif; ?>

            <?php
			/** shipping information **/
			 if(wpsc_show_pnp()) : 
			/** disable shipping information on products page **/
			?>

            <?php endif; ?>

            <?php endif; 
			
			/**	close wpsc_product_price **/
			?>
          </div>
          
          
          <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
          <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
          
          <!-- END OF QUANTITY OPTION -->
          <?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
          <?php if(wpsc_product_has_stock()) : ?>
          <div class="wpsc_buy_button_container">
            <div class="wpsc_loading_animation"> <img title="" alt="<?php esc_attr_e( 'Loading', 'wpsc' ); ?>" src="<?php echo wpsc_loading_animation_url(); ?>" />
              <?php _e('Updating cart...', 'wpsc'); ?>
            </div>
            <!--close wpsc_loading_animation-->
            <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
            <?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
            <input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
            <?php else: ?>
            <input type="submit" value="<?php _e(get_option('3mark_word_add_to_cart','Add To Cart'), 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
            <?php endif; ?>
            <div class="separator"></div>
          </div>
          <!--close wpsc_buy_button_container-->
          <?php endif ; ?>
          <?php endif ; ?>
          
          
          
          
          <div class="entry-utility wpsc_product_utility">
            <?php edit_post_link( __( 'Edit', 'wpsc' ), '<span class="edit-link">', '</span>' ); ?>
          </div>
          <?php do_action ( 'wpsc_product_form_fields_end' ); ?>
        </form>
        <!--close product_form-->
        
        <?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
        <?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
        <?php endif ; ?>
        <?php 
		//	disable product rater in the products page
		//echo wpsc_product_rater(); ?>
        <?php // */ ?>
      </div>
      <!--close productcol-->

    </div>
    <!--close default_product_display-->
    
    <?php endwhile; ?>
    <?php /** end the product loop here */?>
    
    <!-- additional -->
    
    <div class="separator"></div>
