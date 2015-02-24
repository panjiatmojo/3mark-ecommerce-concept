<div class="pagination-wrapper">
  <ul class="pagination">
    <?php if($this->show_navigation == true):?>
    <li class="first navigation"><a href="?<?php echo Ecc_Pagination::get_query_string($this->category_string.'&paged=1');?>"><img src="<?php echo ECC_PAGINATION_URL.'image/first.png';?>"/></a></li>
    <li class="previous navigation"><a href="?<?php echo Ecc_Pagination::get_query_string($this->category_string.'&paged='.$this->previous_page);?>"><img src="<?php echo ECC_PAGINATION_URL.'image/prev.png';?>"/></a></li>
    <?php endif;?>
    <?php for($i = $this->start_page; $i <= $this->last_page; $i++):?>
    <li class="page <?php echo ($i == $this->current_page)? "active-page":"";?>"><a href="?<?php echo Ecc_Pagination::get_query_string($this->category_string.'&paged='.$i);?>"><?php echo $i;?></a></li>
    <?php endfor;?>
    <?php if($this->show_navigation == true):?>
    <li class="next navigation"><a href="?<?php echo Ecc_Pagination::get_query_string($this->category_string.'&paged='.$this->next_page);?>"><img src="<?php echo ECC_PAGINATION_URL.'image/next.png';?>"/></a></li>
    <li class="last navigation"><a href="?<?php echo Ecc_Pagination::get_query_string($this->category_string.'&paged='.$this->last_page);?>"><img src="<?php echo ECC_PAGINATION_URL.'image/last.png';?>"/></a></li>
    <?php endif;?>
  </ul>
</div>
