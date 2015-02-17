<?php
/**
 * The Header for SPEEDO theme.
 * @package WordPress
 */
?>
<!DOCTYPE html>
<html>
<?php 
require_once('functions.php'); 
?>
<head>

<?php if( get_option(prefix.'BTtitle') ) { ?>
<title><?php $BTtitle = get_option(prefix.'BTtitle'); echo stripslashes($BTtitle); ?></title>
<?php } else { ?>
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<?php } ?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php $google_vercode= get_option(prefix.'google_vercode'); echo stripslashes($google_vercode); ?>

<?php if( get_option('SPEEDO_favicon') ) { ?>
<link rel="Shortcut Icon" href="<?php $favicon = get_option(prefix.'favicon'); echo stripslashes($favicon); ?>" type="image/x-icon" />
<?php } else { ?>
<link rel="Shortcut Icon" href="<?php echo SPEEDO_THEME_IMG; ?>/favicon.png" type="image/x-icon" />
<?php } ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_DIR; ?>/style.css" />
<?php if( get_option(prefix.'theme_style') == 'Green' ) { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/green.css" />
<?php } elseif( get_option(prefix.'theme_style') == 'Blue' ) { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/blue.css" />
<?php } elseif( get_option(prefix.'theme_style') == 'Orange' ) { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/orange.css" />
<?php } elseif( get_option(prefix.'theme_style') == 'Purple' ) { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/purple.css" />
<?php } elseif( get_option(prefix.'theme_style') == 'Red' ) { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/red.css" />
<?php } else { ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo SPEEDO_THEME_CSS; ?>/orange.css" />
<?php } ?>
    
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/countdown.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/speedometer.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/jqcanvas.js"></script>
<!--[if IE 8]>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/jqcanvas.IE.js"></script>
<![endif]--> 
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/excanvas.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/easing.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/progression.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/livetwitter.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/form.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_FONTS; ?>/cufon.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_FONTS; ?>/Toyota_MR2.font.js"></script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/corner.js"></script>
<script type="text/javascript">

	<!-- COUNTDOWN TIME SETUP -->
	var startYear  = parseInt(<?php if( get_option(prefix.'startYear') ) { ?><?php $startYear= get_option(prefix.'startYear'); echo stripslashes($startYear); ?><?php } else { ?>2003<?php } ?>);
	var startMonth = parseInt(<?php if( get_option(prefix.'startMonth') ) { ?><?php $startMonth= get_option(prefix.'startMonth'); echo stripslashes($startMonth); ?><?php } else { ?>1<?php } ?>);
	var startDay   = parseInt(<?php if( get_option(prefix.'startDay') ) { ?><?php $startDay= get_option(prefix.'startDay'); echo stripslashes($startDay); ?><?php } else { ?>1<?php } ?>);
	var startHour  = parseInt(<?php if( get_option(prefix.'startHour') ) { ?><?php $startHour= get_option(prefix.'startHour'); echo stripslashes($startHour); ?> <?php } else { ?>0<?php } ?>);
	var startMin   = parseInt(<?php if( get_option(prefix.'startMin') ) { ?><?php $startMin= get_option(prefix.'startMin'); echo stripslashes($startMin); ?><?php } else { ?>0<?php } ?>);
	var startSec   = parseInt(<?php if( get_option(prefix.'startSec') ) { ?><?php $startSec= get_option(prefix.'startSec'); echo stripslashes($startSec); ?><?php } else { ?>0<?php } ?>);
	
	var endYear  = parseInt(<?php if( get_option(prefix.'endYear') ) { ?><?php $endYear= get_option(prefix.'endYear'); echo stripslashes($endYear); ?><?php } else { ?>2014<?php } ?>);
	var endMonth = parseInt(<?php if( get_option(prefix.'endMonth') ) { ?><?php $endMonth= get_option(prefix.'endMonth'); echo stripslashes($endMonth); ?><?php } else { ?>1<?php } ?>);
	var endDay   = parseInt(<?php if( get_option(prefix.'endDay') ) { ?><?php $endDay= get_option(prefix.'endDay'); echo stripslashes($endDay); ?><?php } else { ?>1<?php } ?>);
	var endHour  = parseInt(<?php if( get_option(prefix.'endHour') ) { ?><?php $endHour= get_option(prefix.'endHour'); echo stripslashes($endHour); ?><?php } else { ?>0<?php } ?>);
	var endMin   = parseInt(<?php if( get_option(prefix.'endMin') ) { ?><?php $endMin= get_option(prefix.'endMin'); echo stripslashes($endMin); ?><?php } else { ?>0<?php } ?>);
	var endSec   = parseInt(<?php if( get_option(prefix.'endSec') ) { ?><?php $endSec= get_option(prefix.'endSec'); echo stripslashes($endSec); ?><?php } else { ?>0<?php } ?>);
	
	<!-- COUNTDOWN MESSAGE SETUP -->
	<?php if( get_option(prefix.'cdn_msg') ) { ?>
	var cdnmsg = '<p><?php $cdn_msg = get_option(prefix.'cdn_msg'); echo stripslashes($cdn_msg); ?>';
	<?php } else { ?>
	var cdnmsg = '<p>If everything goes as planned, we&prime;ll be ready in :';
	<?php } ?>
	
	<!-- TWITTER SETUP -->
	var twetUser = '<?php if( get_option(prefix.'twitter') ) { ?><?php $twitter = get_option(prefix.'twitter'); echo stripslashes($twitter); ?><?php } else { ?>woowwebid<?php } ?>';
	var twetNum = <?php if( get_option(prefix.'twitter_num') ) { ?><?php $twitter_num = get_option(prefix.'twitter_num'); echo stripslashes($twitter_num); ?><?php } else { ?>1<?php } ?>;
	
	<!-- PROGRESSBAR SETUP -->
	<?php if( get_option(prefix.'theme_style') == 'Green' ) { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/green/progress.png';
	<?php } elseif( get_option(prefix.'theme_style') == 'Blue' ) { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/blue/progress.png';
	<?php } elseif( get_option(prefix.'theme_style') == 'Orange' ) { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/orange/progress.png';
	<?php } elseif( get_option(prefix.'theme_style') == 'Purple' ) { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/purple/progress.png';
	<?php } elseif( get_option(prefix.'theme_style') == 'Red' ) { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/red/progress.png';
	<?php } else { ?>
	var progressbar = '<?php echo SPEEDO_THEME_IMG; ?>/orange/progress.png';
	<?php } ?>
		
	<!-- SUBSCRIBER FORM SETUP -->
	var subsprocessor = '<?php if( get_option(prefix.'scb_mtd') == 'Basic Process' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber.php<?php } elseif( get_option(prefix.'scb_mtd') == 'Send to My Email' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber-mail.php<?php } elseif( get_option(prefix.'scb_mtd') == 'Send to My Gmail' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber-gmail.php<?php } else { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber.php<?php } ?>';
	
	<!-- CONTACT FORM SETUP -->
	var contactprocessor = '<?php if( get_option(prefix.'mail_process') == 'Basic Process' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail.php<?php } elseif( get_option(prefix.'mail_process') == 'Gmail SMTP' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail-smtp.php<?php } else { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail.php<?php } ?>';

</script>
<script type="text/javascript" src="<?php echo SPEEDO_THEME_JS; ?>/functions.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo SPEEDO_THEME_CSS; ?>/IE7.css" />
<![endif]--> 
<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo SPEEDO_THEME_CSS; ?>/IE8.css" />
<![endif]--> 
<!--[if IE 9]>
<link rel="stylesheet" href="<?php echo SPEEDO_THEME_CSS; ?>/IE9.css" />
<![endif]--> 
    
</head>

<body>
