<?php

require_once('ecc-feed.class.php');

Ecc_Feed::show_feed('facebook', 'kontainerbags', 5);
Ecc_Feed::get_feed('twitter', 'kontainerbags', 2);
Ecc_Feed::show_feed('tumblr', 'kontainerbags', 2);

?>