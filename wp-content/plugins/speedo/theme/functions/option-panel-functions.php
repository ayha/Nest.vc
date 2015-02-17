<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/
function SPEEDO_head() { do_action( 'SPEEDO_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/
function SPEEDO_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('SPEEDO_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) ) {
	
	//Call action that sets
	add_action('admin_head','SPEEDO_option_setup');
	
	//Do redirect
	header( 'Location: '.admin_url().'admin.php?page=speedo_optionspanel' ) ;
	
}

function SPEEDO_option_setup(){

	//Update EMPTY options
	$the_array = array();
	add_option('the_options',$the_array);

	$the_template = get_option('the_template');
	$saved_options = get_option('the_options');
	
	foreach($the_template as $varoption) {
		if($varoption['type'] != 'heading'){
			$id = $varoption['id'];
			$std = $varoption['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($varoption['type'])) {
					foreach($varoption['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$the_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$the_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$the_array[$id] = $db_option;
			}
		}
	}
	update_option('the_options',$the_array);
}

?>