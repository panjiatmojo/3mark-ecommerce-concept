<?php

switch ($service)
{

case "twitter":
?>

<?php //print_r($content);?>

<li class="feed-list twitter">
  <div class="feed-list image"><img src=""/></div>
  <div class="feed-list detail">
    <div class="feed-list username"></div>
    <div class="feed-list content"><?php Ecc_Feed::show_description($content->text);?></div>
    <div class="feed-list time"><?php echo $content->created_at;?></div>
    <div class="feed-list action-1"></div>
    <div class="feed-list action-2"></div>
    <div class="feed-list action-3"></div>
  </div>
</li>
<?php
break;

case "facebook":

?>
<li class="feed-list facebook">
  <div class="feed-list image"><img src=""/></div>
  <div class="feed-list detail">
    <div class="feed-list username"><?php echo $content->author;?></div>
    <div class="feed-list title">
      <?php /*Ecc_Feed::show_title($content->title)*/;?>
    </div>
    <div class="feed-list content">
      <?php Ecc_Feed::show_description($content->description);?>
    </div>
    <div class="feed-list time"><?php echo $content->pubDate;?></div>
    <div class="feed-list action-1"></div>
    <div class="feed-list action-2"></div>
    <div class="feed-list action-3"></div>
  </div>
 </li>
<?php
break;

case "tumblr":

?>
<li class="feed-list tumblr">
  <div class="feed-list image"><img src=""/></div>
  <div class="feed-list detail">
    <div class="feed-list username"></div>
    <div class="feed-list title">
      <?php /*Ecc_Feed::show_title($content->title)*/;?>
    </div>
    <div class="feed-list content">
      <?php Ecc_Feed::show_description($content->description);?>
    </div>
    <div class="feed-list content-image"><img src=""/></div>
    <div class="feed-list time"><?php echo $content->pubDate;?></div>
    <div class="feed-list action-1"></div>
    <div class="feed-list action-2"></div>
    <div class="feed-list action-3"></div>
  </div>
</li>
<?php

break;
}
?>
