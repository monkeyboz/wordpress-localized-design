<?php
	define('WP_USE_THEMES', true);

	/** Loads the WordPress Environment and Template */
	require( '../../../wp-includes/wp-blog-header.php' );
	activate_plugin($_POST['file'].'/'.$_POST['file'].'.php');
?>
