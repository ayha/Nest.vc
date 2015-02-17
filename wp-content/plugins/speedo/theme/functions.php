<?php

//-----------------------------------------------------------------------------
// CLEAN UP WP-HEAD
//-----------------------------------------------------------------------------
// Remove Really simple discovery link
remove_action('wp_head', 'rsd_link');
// Remove Windows Live Writer link
remove_action('wp_head', 'wlwmanifest_link');
// Remove the version number
remove_action('wp_head', 'wp_generator');

//-----------------------------------------------------------------------------
// REMOVE CURLY QUOTES
//-----------------------------------------------------------------------------
remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');

//-----------------------------------------------------------------------------
// LOG-OUT REDIRECT
//-----------------------------------------------------------------------------
// the url you want users to be redirected too after logging out
$logout_redirect_url = get_option('siteurl'); 
if ( $_GET['loggedout'] == 'true' ) {
	add_action('login_head', 'plugin_logout_redirect');
}

function plugin_logout_redirect(){
	global $logout_redirect_url;

	echo "
	<SCRIPT LANGUAGE='JavaScript'>
	window.location='" . $logout_redirect_url . "';
	</script>
	";
}

//-----------------------------------------------------------------------------
// DISABLING WORDPRESS WPAUTOP & WPTEXTURIZE FILTERS
//-----------------------------------------------------------------------------
function plugin_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'plugin_formatter', 99);
add_filter('widget_text', 'plugin_formatter', 99);

define ('prefix', 'SPEEDO_');

?>