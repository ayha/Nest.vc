<?php

/*
 * This file is for loading demo styles only.
 */

function qs_demo_css() {

	wp_register_style( 'colorpicker-demo', QS_BASE_URL . '/library/admin/css/colorpicker.css', null, false ); 	
	wp_enqueue_style( 'colorpicker-demo' ); 

}
add_action('wp_enqueue_scripts', 'qs_demo_css');

function qs_demo_js() {
	
	wp_register_script( 'slideout', QS_BASE_URL . '/js/jquery.tabSlideOut.v1.3.js', array('jquery'), false, true ); 
	wp_register_script( 'colorpicker-demo', QS_BASE_URL . '/library/admin/js/colorpicker.js', array('jquery'), false, true );
        wp_register_script( 'demo', QS_BASE_URL . '/js/demo.js', array('jquery'), false, true );
	
	wp_enqueue_script('slideout'); 
	wp_enqueue_script('colorpicker-demo'); 
        wp_enqueue_script('demo'); 

}
add_action( 'wp_enqueue_scripts', 'qs_demo_js' );

function qs_demo_tabs() { ?>
<!-- @DEMO ONLY -->
<div class="demo-tab" id="demo-styles">
     <a class="handle" href="http://link-for-non-js-users.html">Content</a>

		
        <h4>Accent Color</h4>
        <p>Control the style of the header, footer, and everything between in the admin panel!</p>   
        <form id="accentForm" method="post">
        <div class="colorSelector" id="accentSelector"></div><input id="accentHex" name="accentHex" type="text" style="width:80px; float:left; margin: 0 10px;" /><input type="submit" name="submitColor" value="Apply" />
        <div class="clear"></div>
        </form>
        
        <h4>Demo Styles</h4>
        <p>One page not your cup of tea?  Check out the <a style="text-decoration:underline;" href="http://themeluxe.com/themes/quickstep/non-one-page">non-one-page version</a> of Quickstep.
        <p>Just a few possibilites of what QuickStep can do.</p>     
          
        <div id="demos">
            <img class="demo-image" id="dark" src="<?php echo QS_BASE_URL; ?>/images/demo/demo-full-dark.png" alt="Full Dark Demo" />
            <img class="demo-image" id="" src="<?php echo QS_BASE_URL; ?>/images/demo/demo-full-light.png" alt="Full Dark Demo" />
            <img class="demo-image" id="minimal-dark" src="<?php echo QS_BASE_URL; ?>/images/demo/demo-minimal-dark.png" alt="Full Dark Demo" />
            <img class="demo-image" id="minimal-light" src="<?php echo QS_BASE_URL; ?>/images/demo/demo-minimal-light.png" alt="Full Dark Demo" />
            <img class="demo-image" id="color" src="<?php echo QS_BASE_URL; ?>/images/demo/demo-color.png" alt="Full Dark Demo" />
        </div>
        
        
</div>
<?php 
}
add_action('wp_footer', 'qs_demo_tabs');

?>
