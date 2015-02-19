<?php
   global $previous_post_word, $next_post_word;
    $output = '';
	$exclude_post_type = '';
	
	if (get_query_var('post_type')) {
            $post_type = get_query_var('post_type');
    }
	    
    if (is_singular()):
   ?>   
   <div class="pagination">
      <?php
         $next_post = get_adjacent_post(false, "", false);
         if (!empty( $next_post )): ?>
      <h3 class="next-post"><a href="<?php echo get_permalink( $next_post->ID ); ?>"> < <?php echo $next_post->post_title; ?></a></h3>
      <?php endif; ?>
      <?php
         $previous_post = get_adjacent_post(false, "", true);
         if (!empty( $previous_post )): ?>
      <h3 class="previous-post"><a href="<?php echo get_permalink( $previous_post->ID ); ?>"><?php echo $previous_post->post_title; ?> > </a>
      </h3>
      <?php endif; ?>
      <div class="separator"></div>
   </div>
   <?php
       else:
        global $max_pages, $current_page;
        
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
			
            $output .= '<div class="pagination-wrapper">';
            $output .= '<ul class="pagination">';
            $output .= '<li class="pagination" style="width:15%;float:left;"><a href="?paged=' . '1' . $category . '"> <img src="'.get_template_directory_uri().'/images/double-arrow-left.png"> </a></li>';
	        $output .= '<li class="pagination" style="width:15%;float:left;"><a href="?paged=' . $previous_page . $category . '"> <img src="'.get_template_directory_uri().'/images/arrow-left.png"> </a></li>';
            $output .= '<li class="pagination">' . 'page ' . $current_page . ' of ' . $max_pages . '</li>';
            $output .= '<li class="pagination" style="width:15%;float:right;"><a href="?paged=' . $max_pages . $category . '"> <img src="'.get_template_directory_uri().'/images/arrow-right.png"> </a></li>';
            $output .= '<li class="pagination" style="width:15%;float:right;"><a href="?paged=' . $next_page . $category . '"> <img src="'.get_template_directory_uri().'/images/double-arrow-right.png"> </a></li>';
            $output .= '</ul><div class="separator"></div></div>';
            
            
        } else {
            
            //	if page type is not singular then create complete pagination
            $output .= '<div class="pagination-wrapper">';
            $output .= '<div class="pagination-info">' . 'page ' . $current_page . ' of ' . $max_pages . '</div>';
            $output .= '<ul class="pagination">';
            
            
            $i = 1;
            
            //	if the total pages is 5, then iterate all the page and show it
            if ($max_pages <= 5):
                while ($max_pages > 0):
                    $attribute = ($i == $current_page) ? 'class="active"' : '';
                    $output .= '<li ' . $attribute . '><a href="?&paged=' . $i . $category . '">' . $i . '</a></li>';
                    
                    $i++;
                    $max_pages--;
                endwhile;
            //	if the total pages is more than 5 and current page maximum 3
            elseif ($max_pages > 5 && $current_page <= 3):
                for ($i = 1; $i <= 3; $i++) {
                    $attribute = ($i == $current_page) ? ' class="active"' : '';
                    $output .= '<li' . $attribute . '><a href="?paged=' . $i . $category . '">' . $i . '</a></li>';
                }
                
                $output .= '<li><a href="?&paged=4' . $category . '">4</a></li>' . '<li>...</li>' . '<li><a href="?&paged=' . $max_pages . $category . '">' . $max_pages . '</a></li>';
                //	if the total pages is more than 5 and current page at least max_pages-2
            elseif ($max_pages > 5 && $current_page >= ($max_pages - 2)):
                $output .= '<li><a href="?paged=1' . $category . '">1</a></li>' . '<li>...</li>' . '<li><a href="?paged=' . ($max_pages - 3) . $category . '">' . ($max_pages - 3) . '</a></li>';
                
                for ($i = 2; $i >= 0; $i--) {
                    $attribute = ($max_pages - $i == $current_page) ? ' class="active"' : '';
                    $output .= '<li' . $attribute . '><a href="?paged=' . ($max_pages - $i) . $category . '">' . ($max_pages - $i) . '</a></li>';
                }
                //	if the total pages is more than 5 and current page > 3, then show the first, current-1, current, current +1 & last
            elseif ($max_pages > 5 && $current_page > 3):
                $output .= '<li><a href="?paged=1' . $category . '">1</a></li>' . '<li>...</li>' . '<li><a href="?paged=' . ((int) $current_page - 1) . $category . '">' . ((int) $current_page - 1) . '</a></li>' . '<li ' . 'class="active"' . '><a href="?paged=' . $current_page . $category . '">' . $current_page . '</a></li>' . '<li><a href="?paged=' . ((int) $current_page + 1) . $category . '">' . ((int) $current_page + 1) . '</a></li>' . '<li>...</li>' . '<li><a href="?paged=' . $max_pages . $category . '">' . $max_pages . '</a></li>';
            endif;
            
            $output .= '</ul><div class="separator"></div></div>';
        }
    endif;
    wp_reset_postdata();
?>