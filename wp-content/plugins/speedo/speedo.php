<?php /*
**************************************************************************
Plugin Name:  Speedo
Plugin URI:   http://woow.web.id/
Version:      1.0.0
Description: Speedo is an Under Construction/Maintenance, Coming Soon Page Template for a new website when it is preparing the design and contents or for a website that are down for maintenance. Designed and Developed by by <a href="http://woow.web.id/" target="_blank">WOOW.web.ID</a>.
Author:       WOOW.web.ID
Author URI:   http://woow.web.id
**************************************************************************/
require_once( dirname(__FILE__) . '../../../../wp-load.php');
//-----------------------------------------------------------------------------
// DEFINE DIRECTORY CONSTANS
//-----------------------------------------------------------------------------
define( 'SPEEDO_PLUGIN_DIR', WP_PLUGIN_URL . '/' . basename ( dirname ( __FILE__ ) ) . '/' );
define( 'SPEEDO_THEME_DIR', SPEEDO_PLUGIN_DIR . '/theme' );
define( 'SPEEDO_THEME_JS', SPEEDO_THEME_DIR . '/js' );
define( 'SPEEDO_THEME_CSS', SPEEDO_THEME_DIR . '/css' );
define( 'SPEEDO_THEME_FONTS', SPEEDO_THEME_DIR . '/fonts' );
define( 'SPEEDO_THEME_IMG', SPEEDO_THEME_DIR . '/images' );

//-----------------------------------------------------------------------------
// START SPEEDO CLASS
//-----------------------------------------------------------------------------
class SPEEDO
{
    protected $_exception_urls = array( 'wp-login.php', 'async-upload.php', '/plugins/', 'wp-admin/', 'upgrade.php', 'trackback/', 'feed/' );
	
    function __construct()
    {
        add_action( 'init', array(&$this, 'maintenance_active') );
        wp_enqueue_script('jquery');
    }
	
    public function maintenance_active(){
        if ( !$this->check_user_capability() && !$this->is_page_url_excluded() )
        {
            nocache_headers();
            header("HTTP/1.0 503 Service Unavailable");
            include('theme/index.php');
            exit();
        }
    }

    public function check_user_capability()
    {
        if ( is_super_admin() || current_user_can('manage_options') ) return true;

        return false;
    }

    public function is_page_url_excluded()
    {
        foreach ( $this->_exception_urls as $url ){
            if ( strstr( $_SERVER['PHP_SELF'], $url) ) return true;
        }
        if ( strstr($_SERVER['QUERY_STRING'], 'feed=') ) return true;
        return false;
    }

} 

//-----------------------------------------------------------------------------
// SHOW THE OPTION PANEL
//-----------------------------------------------------------------------------
	require_once('theme/functions/option-panel-functions.php');
	require_once('theme/functions/option-panel-interface.php');
	require_once('theme/functions/the-options.php');
	
//-----------------------------------------------------------------------------
// Add sub page to the Settings Menu
//-----------------------------------------------------------------------------
function SPEEDO_Init() { 
	global $SPEEDO; $SPEEDO = new SPEEDO(); 
}
add_action( 'init', 'SPEEDO_Init', 5 );

//-----------------------------------------------------------------------------
// INCLUDING THEME FUNCTION
//-----------------------------------------------------------------------------

	include('theme/functions.php');

?>
