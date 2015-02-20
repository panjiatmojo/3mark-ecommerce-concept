<?php
/**	load the default configuration	**/
require(ECC_THEME_HOME_DIR.'/config/config.php');

wp_enqueue_script('ecc-init-admin', get_template_directory_uri().'/library/js/ecc-init-admin.js', array('jquery'), '1.0', false);

if($_POST['action'] == 'update')
{
	foreach($_POST as $key => $content)
	{
		if(preg_match('/^ecc_.*$/',$key))
		{ 
			//	only update option if started with ecc_
			update_option($key, $_POST[$key]);
		}
	}
}

$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'option-general';
$current_page = isset( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'ecc_admin_option_menu';

?>

<div class="wrap">
  <div id="icon-themes" class="icon32"></div>
  <h2>Commerce Theme Options</h2>
  <?php settings_errors(); ?>
  <h2 class="nav-tab-wrapper">
    <?php foreach($tab as $key => $tab_parameter):?>
    <a href="?page=<?php echo $current_page;?>&tab=<?php echo $tab_parameter['tab_slug'];?>" class="nav-tab <?php if($tab_parameter['tab_slug'] == $active_tab){echo 'nav-tab-active';}?>"> <?php echo $tab_parameter['tab_name'];?> </a>
    <?php endforeach;?>
  </h2>
  <form method="post" class="ecc-admin-form">
    <input type="hidden" name="action" value="update">
    <?php 
	if(file_exists(__DIR__.'/ecc-'.$active_tab.'.php'))
	{
		include(__DIR__.'/ecc-'.$active_tab.'.php');
	}
	?>
  </form>
</div>
