<?php global $menu_list;

$menu_temp = $menu_list;
?>

<div class="menu-button">
  <div class="ecc-menu-logo-wrapper"><img class="ecc-menu-logo" width="30px" height="30px" src="<?php echo get_template_directory_uri().'/images/ecc-dropdown-black.png'?>"/></div>
</div>
<!--	menu for larger view	-->
<ul id="menus" class="flexnav large" data-breakpoint="1280">
  <?php foreach($menu_list as $slug => $content):?>
  <?php $class = ($content['class'])? $content['class']." " : "";
	?>
  <li class="<?php echo $class;?>">
    <?php if($content['link'] === false):?>
    <span>
    <?php _e($content['content']);?>
    </span>
    <?php else:?>
    <a href="<?php echo site_url().'/'.$content['url']; ?>">
    <?php _e($content['content']);?>
    </a>
    <?php endif;?>
    <?php echo ($content['child']) ? $content['child'] : "";?> </li>
  <?php endforeach;?>
</ul>
<!--	menu for smaller view	-->
<ul id="menus" class="flexnav small" data-breakpoint="1280">
  <?php foreach($menu_list as $slug => $content):?>
  <?php $class = ($content['class'])? $content['class']." " : "";
	?>
    <?php if($content['mobile'] !== false):?>
  <li class="<?php echo $class;?>">
    <?php if($content['link'] === false):?>
    <span>
    <?php _e($content['content']);?>
    </span>
    <?php else:?>
    <a href="<?php echo site_url().'/'.$content['url']; ?>">
    <?php _e($content['content']);?>
    </a>
    <?php endif;?>
    <?php echo ($content['child']) ? $content['child'] : "";?> </li>
<?php endif;?>
  <?php endforeach;?>
</ul>
