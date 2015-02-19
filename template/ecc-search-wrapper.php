<div id="ecc-search-container">
  <ul class="sf-menu">
    <li id="ecc-shopping-cart-wrapper"><a href="<?php echo get_option('home').'/cart';?>" style="display:table"><img style="display:table-cell;vertical-align:middle;" class="shopping-cart" src="<?php echo ECC_IMAGE_URI.'ecc-shopping.png';?>"/></a></li>
    <li id="ecc-search-wrapper" class="">SEARCH&nbsp;
      <ul>
        <li>
        <form method="get" action="<?php echo get_option('home');?>">
          <input type="text" name="s" value="" placeholder="Search Here"/>
          </form>
        </li>
      </ul>
    </li>
    <div style="clear:both"></div>
  </ul>
</div>
<style>
#ecc-search-container
{
	float: right;
	max-width: 50%;
	width: 20%;	
	height:60px;
	overflow:visible;
}

#ecc-search-container ul
{
	display: block;
	width: 100%;
	height:100%;
	line-height:60px;
	overflow:visible;
}

#ecc-search-container ul > li
{
	display:block;
	vertical-align:middle;			
	text-align:center;
	float:left;
	max-width:50%;
	width:50%;
	height:60px;
}


#ecc-search-container ul ul
{
	border:none !important;	
	outline:none !important;
	margin:0px;
	padding:0px;
	float:right;
}

#ecc-search-container ul ul > li form,
#ecc-search-container ul ul
{
	float:right;
}

</style>
