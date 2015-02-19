<?php
//	call all require or include fucntion here
//	declare all required php variable here

require_once('functions.php');
require_once('library/php/mobile-detect/mobile-detect.php');

$word_search = get_option("3mark_word_search","Search Here");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php ecc_load_header_meta();?>
<?php ecc_load_header_script();?>

</head>
<body id="home" class="<?php echo get_view_type();?>">
<?php get_template_part('template/ecc', 'header');?>
