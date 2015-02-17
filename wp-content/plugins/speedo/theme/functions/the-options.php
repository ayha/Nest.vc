<?php

add_action('init','the_options');

if (!function_exists('the_options')) {
function the_options(){
	
// VARIABLES
$templatename = 'Speedo';
$the_prefix = 'SPEEDO';

// Populate OptionsFramework option in array for use in theme
global $the_options;
$the_options = get_option('the_options');

$GLOBALS['template_path'] = get_bloginfo('stylesheet_directory');

//Access the WordPress Categories via an Array
$the_categories = array();  
$the_categories_obj = get_categories('hide_empty=0');
foreach ($the_categories_obj as $the_cat) {
    $the_categories[$the_cat->cat_ID] = $the_cat->cat_name;}
$categories_tmp = array_unshift($the_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$the_pages = array();
$the_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($the_pages_obj as $the_page) {
    $the_pages[$of_page->ID] = $the_page->post_name; }
$the_pages_tmp = array_unshift($the_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Select Options
$IT_base = array("one" => "Image Base","two" => "Text Base");
$IC_base = array("one" => "Image Base","two" => "Color Base");
$ICd_base = array("one" => "Image Base","two" => "Code Base"); 
$opt_style = array("one" => "Green","two" => "Blue","three" => "Orange","four" => "Red","five" => "Purple");
$opt_use = array("one" => "Select option:","two" => "Enable","three" => "Disable");
$opt_display = array("one" => "Show","two" => "Hide");
$opt_YN = array("one" => "Yes","two" => "No");
$opt_CM = array("one" => "","two" => "by Category","three" => "Manual");
$opt_Mail = array("one" => "Basic Process","two" => "Gmail SMTP");
$opt_Subscriber = array("one" => "Basic Process","two" => "FeedBurner Service","three" => "Send to My Email","four" => "Send to My Gmail");

//Stylesheets Reader
$alt_stylesheet_path = STYLESHEETPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('the_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$blogURL = get_bloginfo('url');

// Set the Options Array
$varoptions = array();

// TIMER SETUP
$varoptions[] = array( "name" => "Time Setup",
                    "type" => "heading");

$varoptions[] = array( "title" => "MAINTENANCE START DATE/TIME",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "Maintenance Start Year",
					"desc" => "Enter the maintenance start Year.",
					"id" => $the_prefix."_startYear",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance Start Month",
					"desc" => "Enter the maintenance start Month (value is between 1 to 12).",
					"id" => $the_prefix."_startMonth",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance Start Day",
					"desc" => "Enter the maintenance start Day (value is between 1 to 31).",
					"id" => $the_prefix."_startDay",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance Start Hour",
					"desc" => "Enter the maintenance start Hour (value is between 0 to 23).",
					"id" => $the_prefix."_startHour",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance Start Minute",
					"desc" => "Enter the maintenance start Minute (value is between 0 to 59).",
					"id" => $the_prefix."_startMin",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance Start Second",
					"desc" => "Enter the maintenance start Second (value is between 0 to 59).",
					"id" => $the_prefix."_startSec",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "title" => "MAINTENANCE END DATE/TIME",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "Maintenance End Year",
					"desc" => "Enter the maintenance end Year.",
					"id" => $the_prefix."_endYear",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance End Month",
					"desc" => "Enter the maintenance end Month (value is between 1 to 12).",
					"id" => $the_prefix."_endMonth",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance End Day",
					"desc" => "Enter the maintenance end Day (value is between 1 to 31).",
					"id" => $the_prefix."_endDay",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance End Hour",
					"desc" => "Enter the maintenance end Hour (value is between 0 to 23).",
					"id" => $the_prefix."_endHour",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance End Minute",
					"desc" => "Enter the maintenance end Minute (value is between 0 to 59).",
					"id" => $the_prefix."_endMin",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Maintenance End Second",
					"desc" => "Enter the maintenance end Second (value is between 0 to 59).",
					"id" => $the_prefix."_endSec",
					"std" => "",
					"type" => "text"); 

// GENERAL SETTINGS
$varoptions[] = array( "name" => "General Settings",
                    "type" => "heading");

$varoptions[] = array( "title" => "SELECT THEME STYLE",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "",
					"desc" => "Select color scheme that you want to use.",
					"id" => $the_prefix."_theme_style",
					"std" => "Orange",
					"type" => "select",
					"options" => $opt_style);

$varoptions[] = array( "title" => "MAIN MESSAGES SECTION",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "Main Message First Text",
					"desc" => "Enter your first text message in the box provided to replace the default one.",
					"id" => $the_prefix."_main_msg1",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Main Message Second Text",
					"desc" => "Enter your second text message in the box provided to replace the default one.",
					"id" => $the_prefix."_main_msg2",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "title" => "E-MAIL ACCOUNT DETAILS",
					"msg" => "",
					"type" => "note");

$varoptions[] = array( "name" => "Email Address",
					"desc" => "Enter your Email Address.<!--<br /><span class='caution'><b>Important:</b> If you choose Gmail SMTP option you must enter you Gmail address.</span>-->",
					"id" => $the_prefix."_email_adrs",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Gmail Password",
					"desc" => "Enter your Gmail Password.<br /><span class='caution'><b>Important:</b> If you choose Gmail SMTP option you must enter you Gmail password.</span>",
					"id" => $the_prefix."_email_pass",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "title" => "CUSTOM FAVICON",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "",
					"desc" => "Upload a 35px x 35px png/jpg/gif image that will represent your website's favicon.",
					"id" => $the_prefix."_favicon",
					"std" => "",
					"type" => "upload");

// LOGO SETTINGS
$varoptions[] = array( "name" => "Logo",
                    "type" => "heading");

$varoptions[] = array( "title" => "LOGO SETTINGS",
					"msg" => "",
					"type" => "note"); 
                                               
$varoptions[] = array( "name" => "Custom Image Logo",
					"desc" => "Upload your own logo for your theme, or specify the full image address URL of your online logo (eq: http://yoursite.com/images/mylogo.png).<br /><span class='caution'>Note:<br />1. Recomended image height= 60px and width=230px in supported image file format.<br />2. Leave it blank if you don't use an image logo.</span>",
					"id" => $the_prefix."_logoimg",
					"std" => "",
					"type" => "upload");

$varoptions[] = array( "name" => "First Text Logo",
					"desc" => "Enter your FIRST text in the box provided.",
					"id" => $the_prefix."_logotext1",
					"std" => "",
					"type" => "text"); 

$varoptions[] = array( "name" => "Second Text Logo",
					"desc" => "Enter your SECOND text in the box provided.",
					"id" => $the_prefix."_logotext2",
					"std" => "",
					"type" => "text");

// SOCIAL NETWORK SETTINGS
$varoptions[] = array( "name" => "Social Network",
					"type" => "heading");

$varoptions[] = array( "title" => "TWITTER SETTINGS",
					"msg" => "",
					"type" => "note"); 
                                               
$varoptions[] = array( "name" => "Your Twitter Username",
					"desc" => "Enter your twitter username in the box provided.",
					"id" => $the_prefix."_twitter",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "How many tweets do you want to show?",
					"desc" => "Enter number of your tweets that you want to show in the box provided.",
					"id" => $the_prefix."_twitter_num",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "title" => "FACEBOOK SETTINGS",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "Your Facebook Link",
					"desc" => "Enter full URL to your Facebook in the box provided.",
					"id" => $the_prefix."_facebook",
					"std" => "",
					"type" => "text");

// COUNTDOWN TIMER SETTINGS
$varoptions[] = array( "name" => "Sidebar Section",
                    "type" => "heading");

$varoptions[] = array( "title" => "COUNTDOWN SECTION",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "Countdown Message",
					"desc" => "Enter your countdown section message in the text area provided to replace the default one",
					"id" => $the_prefix."_cdn_msg",
					"std" => "",
					"type" => "textarea"); 

$varoptions[] = array( "title" => "SUBSCRIBER SECTION",
					"msg" => "",
					"type" => "note");

$varoptions[] = array( "name" => "Subscriber Section 1st Text Label",
					"desc" => "Enter your subscriber section 1st text label in the box provided to replace the default one",
					"id" => $the_prefix."_scb_label1",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Subscriber Section 2nd Text Label",
					"desc" => "Enter your subscriber section 2nd Text label in the box provided to replace the default one",
					"id" => $the_prefix."_scb_label2",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Subscriber Section Message",
					"desc" => "Enter your subsriber section message in the box provided to replace the default one",
					"id" => $the_prefix."_scb_msg",
					"std" => "",
					"type" => "textarea"); 

$varoptions[] = array( "name" => "Subscribtion Process",
					"desc" => "Specify how the email subscribtion input data will be processed.<br><span class='caution'><b>NOTE :</b><br />1. <b>The Basic Process</b> will save input data to subscribers.txt file.<br />2. <b>FeedBurner Service</b> will process input data via FeedBurner.<br />3. <b>Send to My Email</b> will send input data to your email address.<br />4. <b>Send to My Gmail</b> will send input data to your Gmail address.</span>",
					"id" => $the_prefix."_scb_mtd",
					"std" => "Basic Process",
					"type" => "select",
					"options" => $opt_Subscriber); 

$varoptions[] = array( "name" => "FeedBurner Feed ID",
					"desc" => "Enter your FeedBurner Feed ID if you choose FeedBurner service to handle your email subscribtion.",
					"id" => $the_prefix."_feedburner",
					"std" => "",
					"type" => "text");

// INFO PAGE SETTINGS
$varoptions[] = array( "name" => "Info Page Section",
					"type" => "heading");

$varoptions[] = array( "title" => "INFO PAGE",
					"msg" => "",
					"type" => "note");

$varoptions[] = array( "name" => "Info Page Title",
					"desc" => "Enter your info page title in the box provided to replace the default one",
					"id" => $the_prefix."_info_ttl",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Main Content",
					"desc" => "Enter your info page main content in the text area provided (HTML allowed).",
					"id" => $the_prefix."_info_main",
					"std" => "",
					"type" => "textarea");

$varoptions[] = array( "name" => "Sidebar Content",
					"desc" => "Enter your info page sidebar content in the text area provided (HTML allowed).",
					"id" => $the_prefix."_info_side",
					"std" => "",
					"type" => "textarea"); 

//  CONTACT PAGE SETTINGS
$varoptions[] = array( "name" => "Contact Page",
					"type" => "heading");

$varoptions[] = array( "title" => "CONTACT PAGE",
					"msg" => "",
					"type" => "note");

$varoptions[] = array( "name" => "Contact Page Title",
					"desc" => "Enter your Contact Page title to overide the default one.",
					"id" => $the_prefix."_cp_ttl",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "name" => "Contact Page Message",
					"desc" => "Enter your Contact Page message to overide the default one.",
					"id" => $the_prefix."_cp_msg",
					"std" => "",
					"type" => "textarea");

$varoptions[] = array( "title" => "EMAIL DELIVERY PROCESS",
					"msg" => "",
					"type" => "note");

$varoptions[] = array( "name" => "Select Email Delivery Process",
					"desc" => "Select the email delivery process, using the Basic Process or use GMail's SMTP server.",
					"id" => $the_prefix."_mail_process",
					"std" => "Basic Process",
					"type" => "select",
					"options" => $opt_Mail);

// SEO TOOLS
$varoptions[] = array( "name" => "SEO Tools",
                    "type" => "heading");

$varoptions[] = array( "title" => "BROWSER TAB TITLE",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "",
					"desc" => "Enter Your Browser Tab Title in the field provided.",
					"id" => $the_prefix."_BTtitle",
					"std" => "",
					"type" => "text");

$varoptions[] = array( "title" => "SITE VERIFICATION CODE",
					"msg" => "",
					"type" => "note"); 

$varoptions[] = array( "name" => "",
					"desc" => "Paste your Site Verification Code from Google Webmaster Central (or other) to Get data about crawling, indexing  search traffic and receive notifications about problems on your site here. This will be added into the header template of your theme.<br />Need more information about Google Webmaster Central? <a href='http://www.google.com/webmasters/' target='_blank'>More Information</a>",
					"id" => $the_prefix."_google_vercode",
					"std" => "",
					"type" => "textarea"); 

$varoptions[] = array( "title" => "GOOGLE ANALYTICS CODE",
					"msg" => "",
					"type" => "note"); 
                                               
$varoptions[] = array( "name" => "",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.<br />Need more information about Google Analytics? <a href='http://www.google.com/analytics/' target='_blank'>More Information</a>",
					"id" => $the_prefix."_google_analytics",
					"std" => "",
					"type" => "textarea"); 

update_option('the_template',$varoptions); 					  
update_option('templatename',$templatename);   
update_option('the_prefix',$the_prefix);

}
}
?>
