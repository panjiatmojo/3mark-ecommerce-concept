<div class="ecc-feed container <?php _e($service);?>">
  <input type="hidden" name="last-feed <?php _e($service);?>" value=""/>
  <ul>
    <?php
foreach ($json_feed as $key => $content) {
	include(__DIR__ . '/ecc-feed-list.php');
}
?>
  </ul>
</div>
<style>
.ecc-feed.container
{
	max-width:30%;
	margin:1.5%;
	width: 480px;
	overflow:hidden;	
}

li.feed-list
{
	border-bottom:1px solid #FFF;	
}
</style>
