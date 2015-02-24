<?php 
/**	class to create pagination	**/

class Ecc_Pagination
{
	public $max_page_shown = 9;
	public $show_navigation = true;
	public $current_page = 1;
	public $left_page = 1;
	public $center_page = 1;
	public $right_page = 1;
	
	public $previous_page = 1;
	public $first_page = 1;
	public $next_page = 1;
	public $max_page = 1;
	
	public $start_page = 1;
	public $last_page = 1;
	
	public $category_string = "";
	
	public $pagination = "";
	
	public $single_page = false;
	
	public function set_max_page($max_pages)
	{
		$this->max_pages_shown = $max_pages;	
	}
	
	public function show_pagination()
	{
		wp_enqueue_style('ecc-pagination', ECC_PAGINATION_URL.'library/css/ecc-pagination.css', '', '1.0.0');
		echo $this->get_pagination();	
	}
	
	public function disable_navigation()
	{
		$this->show_navigation = false;	
	}

	public function enable_navigation()
	{
		$this->show_navigation = true;	
	}
	
	public function get_pagination()
	{
		global $wp_query;
		
		$this->max_page = $wp_query->max_num_pages;
		
		/**	calculate current page	**/
		if(get_query_var('paged'))
		{
			$this->current_page = get_query_var('paged');
		}
		else if(get_query_var('page'))
		{
			$this->current_page = get_query_var('page');	
		}
		else
		{
			$this->current_page = 1;	
		}
		
		/**	calculate start page & last page	**/
		$start_page = $this->current_page - (int)($this->max_page_shown-1)/2;		
		$last_page = $this->current_page + (int)($this->max_page_shown-1)/2;
		
		/**	create category string	**/
		if (get_query_var('cat')) {
			$category = get_query_var('cat');
			$category = '&cat=' . $category;
		} else if (get_query_var('s')) {
			$category = get_query_var('s');
			$category = '&s=' . $category;
		}		
		
		$this->start_page = ($start_page > 0)? $start_page : 1;
		$this->last_page = ($last_page < $this->max_page)? $last_page : $this->max_page;
		
		/**	calculate previous page & next page	**/		
		$this->previous_page = ($this->current_page-1 > 0) ? $this->current_page-1 : 1; 
		$this->next_page = ($this->current_page+1 < $this->max_page) ? $this->current_page+1 : $this->max_page; 
		
		$this->category_string = $category;	
				
		ob_start();		
		include(ECC_PAGINATION_DIR.'/template/ecc-pagination.php');
		$this->pagination = ob_get_contents();
		ob_end_clean();
				
		return $this->pagination;

	}
	
	public static function get_query_string($args)
	{
		$query_string = $_SERVER['QUERY_STRING'];
		
		/**	get existing query string in array	**/		
		parse_str($query_string, $query_string_array);
		
		/**	get new query string in array	**/	
		parse_str($args, $new_string_array);
		
		/**	combine existing with new query string	**/
		$query_string_array = array_merge($query_string_array, $new_string_array);
		
		return http_build_query($query_string_array);
	}
}

?>