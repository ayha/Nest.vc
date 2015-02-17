<script type="text/javascript">

<?php $one_page_enabled = of_get_option('qs_one_page'); ?>
<?php
$home_url = explode('?', home_url());
?>
                
<?php if(!$one_page_enabled && !of_get_option('qs_separate_portfolio')) { ?>
/*-----------------------------------------------------------------------------------

 	AJAX Page Loading
 
-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
		
    // If the link is on site, load it via AJAX
    $('#portfolio-container .portfolio-link').live('click', function(e) {
        e.preventDefault();
		var dataSlide = $(this).attr('data-slide');
		var targetDiv;
		var header = $('header[role="banner"]');
		var offsetHeight = -50;
		if (header.css('position') == 'absolute' || header.css('display') == 'none') { offsetHeight = 0; };
		if($(this).hasClass('portfolio-link')) {
                        var portfolio = true;
			targetDiv = $('#portfolio-loader'); 
                        targetDiv.slideUp(300);
		}
		
        var path = $(this).attr('href');
        var title = $(this).text();
		targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {
			
			if (textStatus == "error") {
			  return "It seems we've encountered an error...";
			}
		
			/*-----------------------------------------------------------------------------------

				Toggles & Accordions (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			
			$(function(){ // run after page loads
					$(".toggle_container").hide(); 
					//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			});
		
			jQuery(".accordion").accordion()
			
			
			/*-----------------------------------------------------------------------------------

				Tabs (AJAX)
			 
			-----------------------------------------------------------------------------------*/
		
                        $('ul.tabs').each(function(i) {
                                //Get all tabs
                                var tab = $(this).find('> li > a');
                                $(this).find('li:first').addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).find("li:first a").addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).next().find("li:first").addClass("active").fadeIn('fast'); //Activate first tab

                                tab.click(function(e) {

                                        //Get Location of tab's content
                                        var contentLocation = $(this).attr('href') + "Tab";

                                        //Let go if not a hashed one
                                        if(contentLocation.charAt(0)=="#") {

                                                e.preventDefault();

                                                //Make Tab Active
                                                tab.parent().removeClass('active');
                                                $(this).parent().addClass('active');

                                                //Show Tab Content & add active class
                                                $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

                                        } 
                                });
                        }); 
			
			

                    /*-----------------------------------------------------------------------------------

                            Sliders (AJAX)

                    -----------------------------------------------------------------------------------*/


                    <?php 
                            $args = array(
                                   'post_type'      => 'slider',
                                   'numberposts'     => 100
                            );


                            $sliders = get_posts( $args );

                            if( $sliders  ) :

                                    foreach ($sliders as $slider) : 

                                            $animation = qs_get_meta('qs_slider_animation', $slider->ID);
                                            $direction = qs_get_meta('qs_slider_direction', $slider->ID);
                                            $slideshow_speed = qs_get_meta('qs_slider_speed', $slider->ID);
                                            $animation_speed = qs_get_meta('qs_slider_animation_speed', $slider->ID);
                                            if(qs_get_meta('qs_slider_control_nav', $slider->ID) == 1) {$control_nav = 'true';} else {$control_nav = 'false';};
                                            if(qs_get_meta('qs_slider_directional_nav', $slider->ID) == 1) {$directional_nav = 'true';} else {$directional_nav = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_action', $slider->ID) == 1) {$action = 'true';} else {$action = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_hover', $slider->ID) == 1) {$hover = 'true';} else {$hover = 'false';};
                                            ?>

                                           
                                              jQuery('.slider-<?php echo $slider->ID; ?>').flexslider({
                                                    animation: "<?php echo $animation; ?>",
                                                    easing: "swing",
                                                    direction: "<?php echo $direction; ?>",
                                                    slideshowSpeed: "<?php echo $slideshow_speed; ?>",
                                                    animationSpeed: "<?php echo $animation_speed; ?>",
                                                    controlNav: <?php echo $control_nav; ?>,               
                                                    directionNav: <?php echo $directional_nav; ?>,  
                                                    pauseOnAction: <?php echo $action; ?>,
                                                    pauseOnHover: <?php echo $hover; ?>,
                                                    useCSS: false
                                              });
                                           

                            <?php endforeach; ?>
                            <?php endif; ?>


			/*-----------------------------------------------------------------------------------

				PrettyPhoto (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			<!-- Makes all photos use PrettyPhoto -->
			/*$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		   		overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over 
		   	});*/
		 	$("a[rel^='prettyPhoto']").prettyPhoto({
			 	overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			 });
			 
			 
			targetDiv.hideLoading();
			targetDiv.height('auto');
                        if(portfolio) { 
                            targetDiv.slideToggle(1000); 
                            offsetHeight = offsetHeight * 2;
                            jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
                            jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset: offsetHeight, axis:'y'}, {queue:false});
                        }
                        portfolio = false;
		});
    });
});    
<?php } ?>
    
<?php if($one_page_enabled) { ?>
/*-----------------------------------------------------------------------------------

 	Page Scrolling
 
-----------------------------------------------------------------------------------*/
<?php 
        if ( !is_home() ) { ?>
            jQuery(document).ready(function($) {  	   
                
                // Change navigation links to home page urls if not on home page
                jQuery('#nav a[href^="<?php echo $home_url[0]; ?>"]:not(.separate)').each(function(){
                   divID = jQuery(this).attr('data-name');
                   href = '<?php echo $home_url[0]; ?>?slide=' + divID;
                   $(this).attr("href", href);
                });
                
                // Change content links to load separate pages
                jQuery('.content a[href^="<?php echo site_url(); ?>"]:not(<?php if(of_get_option('qs_separate_portfolio')) { echo '.portfolio-link, ';} ?><?php if(of_get_option('qs_separate_posts')) { echo '.more-link, ';} ?>.separate, .post-edit-link, .comment-reply-link, #cancel-comment-reply-link, .flex-next, .flex-prev), .content a[href^="/"]:not(<?php if(of_get_option('qs_separate_portfolio')) { echo '.portfolio-link, ';} ?><?php if(of_get_option('qs_separate_posts')) { echo '.more-link, ';} ?>.separate, .post-edit-link, .comment-reply-link, #cancel-comment-reply-link, .flex-next, .flex-prev)').not('<?php if(of_get_option('qs_separate_tags')) { echo '.meta a, ';} else { echo'.separate1 a, '; } ?><?php if(of_get_option('qs_separate_sidebar')) { echo '.sidebar a';} else { echo'.separate2 a'; } ?>').each(function(){
                
                    url = jQuery(this).attr('href');
                    href = '<?php echo $home_url[0]; ?>?load=' + encodeURIComponent(url);
                    $(this).attr("href", href);
                    
                });
                
            });
        <?php } else  { ?>
	
        // If slide or load is set in URL, scroll to it
        jQuery(document).ready(function($) { 
                 <?php if(isset($_GET["slide"])): ?> 
                        
                    var dataSlide = '<?php echo mysql_real_escape_string($_GET["slide"]); ?>';
                    var header = jQuery('header[role="banner"]');
                    var offsetHeight = -50;
                    <?php $header_position = of_get_option('qs_header_position'); ?>
                    
                    if (header.css('position') == 'absolute' || header.css('display') == 'none') { 
                        if(jQuery(window).width() > 767 && <?php if($header_position == 'fadein'){ echo 'true'; } else { echo 'false'; } ?>) { 
                            offsetHeight = -50; 
                        }
                        else {
                            offsetHeight = 0; 
                        }
                    }
                    if (typeof dataSlide !== 'undefined' && dataSlide !== false) { 
                        setTimeout(function() {
                            jQuery(window).scrollTo('div[data-name='+dataSlide+']', {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y'}, {queue:false}); return false;
                        }, 1000);
                    }
                <?php endif; ?>          
                
                 <?php if(isset($_GET["load"])): ?>
                        
                    var path = '<?php echo mysql_real_escape_string(urldecode($_GET["load"])); ?>';
                    var header = jQuery('header[role="banner"]');
                    var offsetHeight = -50;
                    <?php $header_position = of_get_option('qs_header_position'); ?>
                    
                    if (header.css('position') == 'absolute' || header.css('display') == 'none') { 
                        if(jQuery(window).width() > 767 && <?php if($header_position == 'fadein'){ echo 'true'; } else { echo 'false'; } ?>) { 
                            offsetHeight = -50; 
                        }
                        else {
                            offsetHeight = 0; 
                        }
                    }

                    targetDiv = jQuery('#dynamic'); 
                    targetDiv.css('display', 'block');
                    targetDiv.height(2000);
                    jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
                    setTimeout(function() {
                    jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y' }, {queue:false});
                    }, 1000);
                    targetDiv.showLoading();
                    targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {

			
			if (textStatus == "error") {
			  return "It seems we've encountered an error...";
			}
		
			/*-----------------------------------------------------------------------------------

				Toggles & Accordions (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			
			$(function(){ // run after page loads
					$(".toggle_container").hide(); 
					//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			});
		
			jQuery(".accordion").accordion()
			
			
			/*-----------------------------------------------------------------------------------

				Tabs (AJAX)
			 
			-----------------------------------------------------------------------------------*/
		
                        $('ul.tabs').each(function(i) {
                                //Get all tabs
                                var tab = $(this).find('> li > a');
                                $(this).find('li:first').addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).find("li:first a").addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).next().find("li:first").addClass("active").fadeIn('fast'); //Activate first tab

                                tab.click(function(e) {

                                        //Get Location of tab's content
                                        var contentLocation = $(this).attr('href') + "Tab";

                                        //Let go if not a hashed one
                                        if(contentLocation.charAt(0)=="#") {

                                                e.preventDefault();

                                                //Make Tab Active
                                                tab.parent().removeClass('active');
                                                $(this).parent().addClass('active');

                                                //Show Tab Content & add active class
                                                $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

                                        } 
                                });
                        }); 
			
			

                    /*-----------------------------------------------------------------------------------

                            Sliders (AJAX)

                    -----------------------------------------------------------------------------------*/


                    <?php 
                            $args = array(
                                   'post_type'      => 'slider',
                                   'numberposts'     => 100
                            );

                            $sliders = get_posts( $args );

                            if( $sliders  ) :

                                    foreach ($sliders as $slider) : 

                                            $animation = qs_get_meta('qs_slider_animation', $slider->ID);
                                            $direction = qs_get_meta('qs_slider_direction', $slider->ID);
                                            $slideshow_speed = qs_get_meta('qs_slider_speed', $slider->ID);
                                            $animation_speed = qs_get_meta('qs_slider_animation_speed', $slider->ID);
                                            if(qs_get_meta('qs_slider_control_nav', $slider->ID) == 1) {$control_nav = 'true';} else {$control_nav = 'false';};
                                            if(qs_get_meta('qs_slider_directional_nav', $slider->ID) == 1) {$directional_nav = 'true';} else {$directional_nav = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_action', $slider->ID) == 1) {$action = 'true';} else {$action = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_hover', $slider->ID) == 1) {$hover = 'true';} else {$hover = 'false';};
                                            ?>

                                           
                                              jQuery('.slider-<?php echo $slider->ID; ?>').flexslider({
                                                    animation: "<?php echo $animation; ?>",
                                                    easing: "swing",
                                                    direction: "<?php echo $direction; ?>",
                                                    slideshowSpeed: "<?php echo $slideshow_speed; ?>",
                                                    animationSpeed: "<?php echo $animation_speed; ?>",
                                                    controlNav: <?php echo $control_nav; ?>,               
                                                    directionNav: <?php echo $directional_nav; ?>,  
                                                    pauseOnAction: <?php echo $action; ?>,
                                                    pauseOnHover: <?php echo $hover; ?>,
                                                    useCSS: false
                                              });
                                           

                            <?php endforeach; ?>
                            <?php endif; ?>


			/*-----------------------------------------------------------------------------------

				PrettyPhoto (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			<!-- Makes all photos use PrettyPhoto -->
			/*$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		   		overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over 
		   	});*/
		 	$("a[rel^='prettyPhoto']").prettyPhoto({
			 	overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			 });
			 
			 
			targetDiv.hideLoading();
			targetDiv.height('auto');
                        
                    });
                    
                <?php endif; ?>          
        });

        // For top navigation
	jQuery(document).ready(function($) {  
            

		jQuery('#nav a[href^="<?php echo $home_url[0]; ?>"]:not(.separate)').click(function (e) {  
                        e.preventDefault();
			jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
                        var divID = '#' + jQuery(this).attr('data-slide');
			var header = $('header[role="banner"]');
			var offsetHeight = -50;
			if (header.css('position') == 'absolute' || header.css('display') == 'none') { offsetHeight = 0; };
                        if(jQuery(divID).length){
			jQuery(window).scrollTo(divID, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y' }, {queue:false});
			}
                        // If custom menu is used with div not on page
                       	else { 
                            targetDiv = $('#dynamic'); 
                            targetDiv.css('display', 'block');
                            targetDiv.height(2000);
                            jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
                            jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y' }, {queue:false});
                            targetDiv.showLoading();
                            var path = $(this).attr('href');
                            var title = $(this).text();
                            targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {

                            if (textStatus == "error") {
                              return "It seems we've encountered an error...";
                            }

                            /*-----------------------------------------------------------------------------------

                                    Toggles & Accordions (AJAX)

                            -----------------------------------------------------------------------------------*/

                            $(function(){ // run after page loads
                                            $(".toggle_container").hide(); 
                                            //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
                            });

                            jQuery(".accordion").accordion()


                            /*-----------------------------------------------------------------------------------

                                    Tabs (AJAX)

                            -----------------------------------------------------------------------------------*/

                            $('ul.tabs').each(function(i) {
                                    //Get all tabs
                                    var tab = $(this).find('> li > a');
                                    $(this).find('li:first').addClass("active").fadeIn('fast'); //Activate first tab
                                    $(this).find("li:first a").addClass("active").fadeIn('fast'); //Activate first tab
                                    $(this).next().find("li:first").addClass("active").fadeIn('fast'); //Activate first tab

                                    tab.click(function(e) {

                                            //Get Location of tab's content
                                            var contentLocation = $(this).attr('href') + "Tab";

                                            //Let go if not a hashed one
                                            if(contentLocation.charAt(0)=="#") {

                                                    e.preventDefault();

                                                    //Make Tab Active
                                                    tab.removeClass('active');
                                                    $(this).parent().addClass('active');

                                                    //Show Tab Content & add active class
                                                    $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

                                            } 
                                    });
                            }); 

                    /*-----------------------------------------------------------------------------------

                            Sliders (AJAX)

                    -----------------------------------------------------------------------------------*/


                    <?php 
                            $args = array(
                                   'post_type'      => 'slider',
                                   'numberposts'     => 100
                            );

                            $sliders = get_posts( $args );

                            if( $sliders  ) :

                                    foreach ($sliders as $slider) : 

                                            $animation = qs_get_meta('qs_slider_animation', $slider->ID);
                                            $direction = qs_get_meta('qs_slider_direction', $slider->ID);
                                            $slideshow_speed = qs_get_meta('qs_slider_speed', $slider->ID);
                                            $animation_speed = qs_get_meta('qs_slider_animation_speed', $slider->ID);
                                            if(qs_get_meta('qs_slider_control_nav', $slider->ID) == 1) {$control_nav = 'true';} else {$control_nav = 'false';};
                                            if(qs_get_meta('qs_slider_directional_nav', $slider->ID) == 1) {$directional_nav = 'true';} else {$directional_nav = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_action', $slider->ID) == 1) {$action = 'true';} else {$action = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_hover', $slider->ID) == 1) {$hover = 'true';} else {$hover = 'false';};
                                            ?>

                                           
                                              jQuery('.slider-<?php echo $slider->ID; ?>').flexslider({
                                                    animation: "<?php echo $animation; ?>",
                                                    easing: "swing",
                                                    direction: "<?php echo $direction; ?>",
                                                    slideshowSpeed: "<?php echo $slideshow_speed; ?>",
                                                    animationSpeed: "<?php echo $animation_speed; ?>",
                                                    controlNav: <?php echo $control_nav; ?>,               
                                                    directionNav: <?php echo $directional_nav; ?>,  
                                                    pauseOnAction: <?php echo $action; ?>,
                                                    pauseOnHover: <?php echo $hover; ?>,
                                                    useCSS: false
                                              });
                                           

                            <?php endforeach; ?>
                            <?php endif; ?>

                            /*-----------------------------------------------------------------------------------

                                    PrettyPhoto (AJAX)

                            -----------------------------------------------------------------------------------*/
                            <!-- Makes all photos use PrettyPhoto -->
                            /*$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
                                    overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over 
                            });*/
                            $("a[rel^='prettyPhoto']").prettyPhoto({
                                    overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                             });


                            targetDiv.hideLoading();
                            targetDiv.height('auto');
                        });
                      }
		}); 
	});
	<?php } //end is_home changes ?>
<?php } // end one_page changes ?>

	jQuery(document).ready(function($){
	
		// hide #back-top first
		$("#scroll-top").hide();

		
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#scroll-top').fadeIn();
				} else {
					$('#scroll-top').fadeOut();
				}
			});
	
			// scroll body to 0px on click
			$('#scroll-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 1800);
				return false;
			});
		});
		
                // close portfolio button
                $('#portfolio-close').click(function () {
                        $('#portfolio-loader').slideUp(600);
                        return false;
                });
                // close portfolio button
                $('#dynamic-close').click(function () {
                        $('#dynamic').slideUp(600);
                        return false;
                });                

                //  Add active class to current page or section
                if( $("html").is(".ie8, .ie7") ) {}
                else {
                    jQuery(window).scroll(function () {
                      var inview = $('.container:in-viewport:first').attr('id'),
                          $link = $('#nav li a').filter('[data-slide=' + inview + ']');

                      if ($link.length && !$link.parent().is('.active')) {
                        $('#nav li').removeClass('active');
                        $link.parent().addClass('active');   
                        $link.parent().parents('li').addClass('active');   
                      }
                    });
                    jQuery(window).scroll();
                }
                


	});
	
	
/*-----------------------------------------------------------------------------------

 	AJAX Page Loading
 
-----------------------------------------------------------------------------------*/

<?php if($one_page_enabled) { ?>
jQuery(document).ready(function($) {
<?php if(is_home()) { ?>		
    // If the link is on site, load it via AJAX
    $('.content a[href^="<?php echo site_url(); ?>"]:not(<?php if(of_get_option('qs_separate_portfolio')) { echo '.portfolio-link, ';} ?><?php if(of_get_option('qs_separate_posts')) { echo '.more-link, ';} ?>.separate, .meta a, .post-edit-link, .comment-reply-link, #cancel-comment-reply-link, .flex-next, .flex-prev):not(<?php if(of_get_option('qs_separate_tags')) { echo '.meta a, ';} else { echo'.separate1 a, '; } ?><?php if(of_get_option('qs_separate_sidebar')) { echo '.sidebar a';} else { echo'.separate2 a'; } ?>), .content a[href^="/"]:not(<?php if(of_get_option('qs_separate_portfolio')) { echo '.portfolio-link, ';} ?><?php if(of_get_option('qs_separate_posts')) { echo '.more-link, ';} ?>.separate, .meta a, .post-edit-link, .comment-reply-link, #cancel-comment-reply-link, .flex-next, .flex-prev)').live('click', function(e) {
        e.preventDefault();
		var dataSlide = $(this).attr('data-slide');
		var targetDiv;
		var header = $('header[role="banner"]');
		var offsetHeight = -50;
		if (header.css('position') == 'absolute' || header.css('display') == 'none') { offsetHeight = 0; };
		if (typeof dataSlide !== 'undefined' && dataSlide !== false) { jQuery(window).scrollTo('div[data-name='+dataSlide+']', {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y'}, {queue:false}); return false;}
		else if($(this).hasClass('page-nav-link')) { 
			targetDiv = $(this).closest('.container'); 
			jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
			jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y'}, {queue:false});
                        targetDiv.showLoading();
                }
		else if($(this).hasClass('portfolio-link')) {
                        var portfolio = true;
			targetDiv = $('#portfolio-loader'); 
                        targetDiv.slideUp(300);
		}
		else { 
			targetDiv = $('#dynamic'); 
			targetDiv.css('display', 'block');
			targetDiv.height(2000);
			jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
			jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y'}, {queue:false});
                        targetDiv.showLoading();
                }
		
        var path = $(this).attr('href');
        var title = $(this).text();
		targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {
			
			if (textStatus == "error") {
			  return "It seems we've encountered an error...";
			}
		
			/*-----------------------------------------------------------------------------------

				Toggles & Accordions (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			
			$(function(){ // run after page loads
					$(".toggle_container").hide(); 
					//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			});
		
			jQuery(".accordion").accordion()
			
			
			/*-----------------------------------------------------------------------------------

				Tabs (AJAX)
			 
			-----------------------------------------------------------------------------------*/
		
                        targetDiv.find('ul.tabs').each(function(i) {
                                //Get all tabs
                                var tab = $(this).find('> li > a');
                                $(this).find('li:first').addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).find("li:first a").addClass("active").fadeIn('fast'); //Activate first tab
                                $(this).next().find("li:first").addClass("active").fadeIn('fast'); //Activate first tab

                                tab.click(function(e) {

                                        //Get Location of tab's content
                                        var contentLocation = $(this).attr('href') + "Tab";

                                        //Let go if not a hashed one
                                        if(contentLocation.charAt(0)=="#") {

                                                e.preventDefault();

                                                //Make Tab Active
                                                tab.parent().removeClass('active');
                                                $(this).parent().addClass('active');

                                                //Show Tab Content & add active class
                                                $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

                                        } 
                                });
                        }); 
			
			

                    /*-----------------------------------------------------------------------------------

                            Sliders (AJAX)

                    -----------------------------------------------------------------------------------*/


                    <?php 
                            $args = array(
                                   'post_type'      => 'slider',
                                   'numberposts'     => 100
                            );

                            $sliders = get_posts( $args );

                            if( $sliders  ) :

                                    foreach ($sliders as $slider) : 

                                            $animation = qs_get_meta('qs_slider_animation', $slider->ID);
                                            $direction = qs_get_meta('qs_slider_direction', $slider->ID);
                                            $slideshow_speed = qs_get_meta('qs_slider_speed', $slider->ID);
                                            $animation_speed = qs_get_meta('qs_slider_animation_speed', $slider->ID);
                                            if(qs_get_meta('qs_slider_control_nav', $slider->ID) == 1) {$control_nav = 'true';} else {$control_nav = 'false';};
                                            if(qs_get_meta('qs_slider_directional_nav', $slider->ID) == 1) {$directional_nav = 'true';} else {$directional_nav = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_action', $slider->ID) == 1) {$action = 'true';} else {$action = 'false';};
                                            if(qs_get_meta('qs_slider_pause_on_hover', $slider->ID) == 1) {$hover = 'true';} else {$hover = 'false';};
                                            ?>

                                           
                                              jQuery('.slider-<?php echo $slider->ID; ?>').flexslider({
                                                    animation: "<?php echo $animation; ?>",
                                                    easing: "swing",
                                                    direction: "<?php echo $direction; ?>",
                                                    slideshowSpeed: "<?php echo $slideshow_speed; ?>",
                                                    animationSpeed: "<?php echo $animation_speed; ?>",
                                                    controlNav: <?php echo $control_nav; ?>,               
                                                    directionNav: <?php echo $directional_nav; ?>,  
                                                    pauseOnAction: <?php echo $action; ?>,
                                                    pauseOnHover: <?php echo $hover; ?>,
                                                    useCSS: false
                                              });
                                           

                            <?php endforeach; ?>
                            <?php endif; ?>


			/*-----------------------------------------------------------------------------------

				PrettyPhoto (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			<!-- Makes all photos use PrettyPhoto -->
			/*$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		   		overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over 
		   	});*/
		 	$("a[rel^='prettyPhoto']").prettyPhoto({
			 	overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			 });
			 
			 
			targetDiv.hideLoading();
			targetDiv.height('auto');
                        if(portfolio) { 
                            targetDiv.slideToggle(1000); 
                            offsetHeight = offsetHeight * 2;
                            jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
                            jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset: offsetHeight, axis:'y'}, {queue:false});
                        }
                        portfolio = false;
		});
    });
	
/*-----------------------------------------------------------------------------------

	AJAX Search Form
 
-----------------------------------------------------------------------------------*/
    $('#searchform, #noresults-searchform, #error404-searchform').live('submit', $(this), function(event) {
        event.preventDefault();
		targetDiv = $('#dynamic');
		targetDiv.css('display', 'block');
		targetDiv.height(2000);
		var header = $('header[role="banner"]');
		var offsetHeight = -50;
		if (header.css('position') == 'absolute' || header.css('display') == 'none') { offsetHeight = 0; };
		jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
		jQuery(window).scrollTo(targetDiv, {duration:<?php echo of_get_option('qs_scrollto_speed', '1300'); ?>, easing:'<?php echo of_get_option('qs_scrollto_easing', 'swing'); ?>', offset:offsetHeight, axis:'y'}, {queue:false});
		targetDiv.showLoading();
		var data =$(this).serialize();
		var path = "<?php echo site_url(); ?>?"+data;
		targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {
			
			targetDiv.hideLoading();
			targetDiv.height('auto');
			
			//Prettyphoto for search results
			 $("a[rel^='prettyPhoto']").prettyPhoto({
			 	overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			 });
			 <!-- End AJAX PrettyPhoto -->

		});
		
    });
    

<?php } ?>
/*-----------------------------------------------------------------------------------

 	AJAX Commenting
 
-----------------------------------------------------------------------------------*/

		$('[id=commentform]').live( 'submit', $(this), function(event){
				event.preventDefault();
				
				var statusdiv=$('.comment-status', this); // define the infopanel
				//serialize and store form data in a variable
				var formdata=$(this).serialize();
				//Add a status message
				statusdiv.html('<p>Processing...</p>');
				//Extract action URL from commentform
				var formurl=$(this).attr('action');
				//Post Form with data
				$.ajax({
					type: 'post',
					url: formurl,
					data: formdata,
					error: function(XMLHttpRequest, textStatus, errorThrown){
						statusdiv.html('<p class="error" >You might have left one of the fields blank, or be posting too quickly</p>');
					},
					success: function(data, textStatus){
						var trimmedData = $.trim(data);
						if(trimmedData == "success") {
							statusdiv.html('<p class="success" >Thanks for your comment. We appreciate your response.</p>');
						}
						else {
							statusdiv.html('<p class="error" >Please wait a while before posting your next comment</p>');
						}
					}
				});
				return false;
			
		});
		
	
});
<?php } ?>	


/*-----------------------------------------------------------------------------------

 	PrettyPhoto
 
-----------------------------------------------------------------------------------*/
	jQuery(document).ready(function($) {
		<!-- Uncomment below to make all photos use PrettyPhoto -->
	    /*$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		   overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over 
		   });*/
		 $("a[rel^='prettyPhoto']").prettyPhoto({
                         deeplinking:false,
			 overlay_gallery: false /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		});
	})
	


jQuery(document).ready(function($) {


/*-----------------------------------------------------------------------------------

 	Toggles & Accordions
 
-----------------------------------------------------------------------------------*/
	
	jQuery(".accordion").accordion()
	
	$(function(){ // run after page loads
			$(".toggle_container").hide(); 
			//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			$("p.trigger").live('click', function(){
				$(this).toggleClass("active").next().slideToggle("normal");
				return false; //Prevent the browser jump to the link anchor
			});
	});




/*-----------------------------------------------------------------------------------

 	Tabs 
 
-----------------------------------------------------------------------------------*/

	$('ul.tabs').each(function(i) {
		//Get all tabs
		var tab = $(this).find('> li > a');
		$(this).find('li:first').addClass("active").fadeIn('fast'); //Activate first tab
		$(this).find("li:first a").addClass("active").fadeIn('fast'); //Activate first tab
		$(this).next().find("li:first").addClass("active").fadeIn('fast'); //Activate first tab
		
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr('href') + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.parent().removeClass('active');
				$(this).parent().addClass('active');
				
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				
                $('html, body').animate({
                    scrollTop: $(contentLocation).offset().top - 200
                }, 1000);

			} 
		});
	}); 
	
});  //End Document Ready


/*-----------------------------------------------------------------------------------

 	Sliders
 
-----------------------------------------------------------------------------------*/


<?php 
                            $args = array(
                                   'post_type'      => 'slider',
                                   'numberposts'     => 100
                            );

	$sliders = get_posts( $args );
	
	if( $sliders  ) :
	
		foreach ($sliders as $slider) : 
		
			$animation = qs_get_meta('qs_slider_animation', $slider->ID);
			$direction = qs_get_meta('qs_slider_direction', $slider->ID);
			$slideshow_speed = qs_get_meta('qs_slider_speed', $slider->ID);
			$animation_speed = qs_get_meta('qs_slider_animation_speed', $slider->ID);
			if(qs_get_meta('qs_slider_control_nav', $slider->ID) == 1) {$control_nav = 'true';} else {$control_nav = 'false';};
			if(qs_get_meta('qs_slider_directional_nav', $slider->ID) == 1) {$directional_nav = 'true';} else {$directional_nav = 'false';};
			if(qs_get_meta('qs_slider_pause_on_action', $slider->ID) == 1) {$action = 'true';} else {$action = 'false';};
			if(qs_get_meta('qs_slider_pause_on_hover', $slider->ID) == 1) {$hover = 'true';} else {$hover = 'false';};
			?>
			
			jQuery(window).load(function($){
			  jQuery('.slider-<?php echo $slider->ID; ?>').flexslider({
				animation: "<?php echo $animation; ?>",
				easing: "swing",
				direction: "<?php echo $direction; ?>",
				slideshowSpeed: "<?php echo $slideshow_speed; ?>",
				animationSpeed: "<?php echo $animation_speed; ?>",
				controlNav: <?php echo $control_nav; ?>,               
				directionNav: <?php echo $directional_nav; ?>,  
				pauseOnAction: <?php echo $action; ?>,
				pauseOnHover: <?php echo $hover; ?>,
				useCSS: false
			  });
			});

	<?php endforeach; ?>
	<?php endif; ?>
	
/*-----------------------------------------------------------------------------------

 	Responsive Navigation
 
-----------------------------------------------------------------------------------*/
	jQuery(window).load(function($) {
		jQuery("[role='navigation']").flexNav(); 
	});


	<?php $header_position = of_get_option('qs_header_position'); ?>
	<?php if($header_position == 'fadein' && is_home()): ?>

		jQuery(document).ready(function($) {
	
			var divs = $('#header-bg, header[role="banner"]');
			$(window).scroll(function(){
			   if($(window).scrollTop()<<?php echo of_get_option('qs_header_fade_height', '600'); ?> && ($(window).width() > 800)){
					 divs.stop(true,true).fadeOut("slow");
			   } else {
					 divs.stop(true,true).fadeIn("slow");
			   }
			});
		});
	
	<?php endif; ?>

/*-----------------------------------------------------------------------------------

 	Portfolio Filtering
 
-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
  $.Isotope.prototype._getCenteredMasonryColumns = function() {
    this.width = this.element.width();
    
    var parentWidth = this.element.parent().width();
    
                  // i.e. options.masonry && options.masonry.columnWidth
    var colW = this.options.masonry && this.options.masonry.columnWidth ||
                  // or use the size of the first item
                  this.$filteredAtoms.outerWidth(true) ||
                  // if there's no items, use size of container
                  parentWidth;
    
    var cols = Math.floor( parentWidth / colW );
    cols = Math.max( cols, 1 );

    // i.e. this.masonry.cols = ....
    this.masonry.cols = cols;
    // i.e. this.masonry.columnWidth = ...
    this.masonry.columnWidth = colW;
  };
  
  $.Isotope.prototype._masonryReset = function() {
    // layout-specific props
    this.masonry = {};
    // FIXME shouldn't have to call this again
    this._getCenteredMasonryColumns();
    var i = this.masonry.cols;
    this.masonry.colYs = [];
    while (i--) {
      this.masonry.colYs.push( 0 );
    }
  };

  $.Isotope.prototype._masonryResizeChanged = function() {
    var prevColCount = this.masonry.cols;
    // get updated colCount
    this._getCenteredMasonryColumns();
    return ( this.masonry.cols !== prevColCount );
  };
  
  $.Isotope.prototype._masonryGetContainerSize = function() {
    var unusedCols = 0,
        i = this.masonry.cols;
    // count unused columns
    while ( --i ) {
      if ( this.masonry.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }
    
    return {
          height : Math.max.apply( Math, this.masonry.colYs ),
          // fit container to columns that have been used;
          width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
        };
  };

 	

		

	

    (function() {

                            var $container = $('#portfolio-container');

                            $(window).on('load', function() {
                                    // initialize Isotope
                                    $container.isotope({
                                      // options...
                                      resizable: false // disable normal resizing

                                    });
                            });

                            // update columnWidth on window resize
                            $(window).smartresize(function(){
                              $container.isotope({
                                    // update columnWidth to a percentage of container width

                              });
                            });

                            // filter items when filter link is clicked
                            $('#filter a').click(function(){
                              var selector = $(this).attr('data-filter');
                                      <?php $prettyphoto_enabled = of_get_option('qs_portfolio_prettyphoto'); ?>
                                      <?php if ($prettyphoto_enabled == '1') : ?>
                                      $('#portfolio-container .isotope-item a:first-child').attr('rel', 'prettyPhoto[gallery]');
                                      $('#portfolio-container ' + selector + ' a:first-child').attr('rel', 'prettyPhoto[active]');
                                      <?php endif; ?>
                                      $container.isotope({         
                                                    filter: selector,
                                                    animationOptions: {
                                                                    duration: 750,
                                                                    easing: 'linear',
                                                                    queue: false
                                                                    } 
                                       });
                              return false;
                            });

    })();

});

/*-----------------------------------------------------------------------------------

 	Portfolio Captions
 
-----------------------------------------------------------------------------------*/

 	jQuery(document).ready(function($) {
       $(document).ready(function(){
			$('.caption').hide();
			$('#portfolio-container .element').hover(function () {
			$('.caption', this).stop().fadeTo('slow', 1.0);
				},
			function () {
				$('.caption', this).stop().fadeTo('slow', 0); 
			});
        });
	});
	
	
/*-----------------------------------------------------------------------------------

 	Custom User JS
 
-----------------------------------------------------------------------------------*/

<?php echo of_get_option('qs_custom_js'); ?>




// Auto select database group in newsletter signup

    jQuery(document).ready(function($) {
       $(document).ready(function(){
            $('.yikes_mc_interest_group_checkbox[value="Nest Database"]').prop('checked', true);
        });
    });

// Rush Hour Media (RHM) This fixes URIs which were not properly served from PHP
    jQuery(document).ready(function($) {
        $("a[href*='http://nest.vc?load']").each(function(){ 
            $(this).attr('href', decodeURIComponent(jQuery(this).attr('href')).replace('http://nest.vc?load=', '')) 
        });
    });
// End URI fix

// Rush Hour Media (RHM) This fixes the accordions after Dreamgrow plugin broke them.
    jQuery(document).ready(function() {
        jQuery( ".trigger" ).click(function() {
            var container = jQuery(this).parent().find( ".toggle_container" );
            jQuery(container).slideToggle("slow");
            jQuery(".toggle_container").not(container).slideUp();
        });
    });
// End accordions fix


</script>


<script>
	
		jQuery(function($) {
			$('.news_list').bxSlider({
  mode: 'vertical',
  slideMargin: 5,
  minSlides: 3,
  maxSlides: 3,
  slideWidth: 422,
  pager: false,
  infiniteLoop: false, 
  prevText: "<img src='/wp-content/themes/quickstep/images/nest_arrow_up.gif' />",
  nextText: "<img src='/wp-content/themes/quickstep/images/nest_arrow_down.gif' />",
  auto: true,
  autoStart: true,
  pause: 5000,

  moveSlides: 1 
  
});
	
		
		});
	</script>
	
<script>
	
	jQuery(document).ready(function($) {


/* new team page script */
var team_page = "/team/";
// funtion generate thumbnails
var thumbnail_div = "team_thumbnails";
var max_num_per_row = 6;

$(".team_section").each(function(i, ele){
	var section_title = $(this).data("section-title");
	
	$(this).attr("id", "section_"+i);
	var html = '<div class="thumbnail_section" data-section-title="'+section_title+'" data-reference="section_'+i+'">';
	
	html += "<h2>"+section_title+"</h2>";
	
	var member_count = $(this).children(".team_member").length;
	
	html += '<ul id="og-grid" class="og-grid">';
	$(this).children(".team_member").each(function(j, member){
		
		var member_name_title = $(this).find("h4").html();
		var comma_pos = member_name_title.indexOf(",");
		var member_name = member_name_title.substring(0, comma_pos).trim();
		
		var member_title = member_name_title.substring(comma_pos+1).trim();
		var member_alias = member_name.toLowerCase().replace(/\s+/g, '-');
		
		var img_url = $(this).find(".column").first().children("img").attr("src");
		var element_id = "member_"+i+"_"+j;
		$(this).attr("id", element_id);
		$(this).attr("member_name", member_name);
		$(this).attr("member_title", member_title);
		$(this).attr("member_alias", member_alias);
		keywords = $("meta[name=keywords]").attr("content") +","+member_name;
		$("meta[name=keywords]").attr("content", keywords);
		html += '<li><div class="member_thumbnail" data-alias="'+member_alias+'"><div class="thumbnail_content">';
		html += '<a class="member_link" data-target="'+element_id+'" data-alias="'+member_alias+'" href="'+team_page+''+member_alias+'"><img src="'+img_url+'" title="'+member_name+'" alt="'+member_name+'" /></a>';
		html += '<div class="member_name"><a class="member_link" data-target="'+element_id+'" data-alias="'+member_alias+'" href="'+team_page+''+member_alias+'"><h4>'+member_name+'</h4><h5>'+member_title+'</h5></a></div>';
		html += "</div></div></li>";
	
	});
	html +"</ul>";
	
	//html += '<div class="clearboth"></div>';
	
	$("#"+thumbnail_div).append(html);
	
	
});

$("a.member_link").on("click", function(e){
	e.preventDefault();
	//
	show_member_by_hash($(this).data("alias")); 
	window.history.pushState("","", team_page + $(this).data("alias"));
});

show_member_by_hash(window.location.hash.substring(1));



function show_member_by_hash(hash){
	
	hash = hash.replace("!/", "");
	hide_member_info();
	
	var windowW = $(window).width();
	var content = $(".team_member[member_alias="+hash+"]").html();
	
	var currLeft = $(".member_thumbnail[data-alias="+hash+"]").offset().left;
	var currTop =  $(".member_thumbnail[data-alias="+hash+"]").offset().top;
	var newDiv = '<div class="member_details" style="left:-'+currLeft+'px"><div class="member_details_content">';
	newDiv += '<a class="close_member_bio" href="#">Close</a>';
	newDiv += content;
	newDiv += "</div></div>";
	$(".member_thumbnail[data-alias="+hash+"]").height(510);
	
	$(".member_thumbnail[data-alias="+hash+"]").append(newDiv);
	$(".member_thumbnail .member_details").width(windowW-30);
	var newHeight = $(".member_thumbnail[data-alias="+hash+"] .member_details").height();
	//console.log(newHeight);
	//alert(newHeight);
	if(newHeight > 300){
		$(".member_thumbnail[data-alias="+hash+"] .member_details").finish().animate({height: (newHeight+50)}, 300);
		$(".member_thumbnail[data-alias="+hash+"]").finish().animate({height: (newHeight+206)}, 300);
	}
	$("html, body").animate({ scrollTop: currTop }, 500);
	//alert( $(".member_thumbnail[data-alias="+hash+"] .member_details").height());  
	
	
$("body").on("click", ".close_member_bio",  function(e){
	
	e.preventDefault();
	$(".member_details_content").animate({"height":"0px"}, 300);
	$(".member_details").fadeOut(300, function(){
		$(".member_details").remove();
		$(".member_thumbnail").height(156);
		
	});
	
});
	
}


function hide_member_info(){
	
	
	$(".member_details").remove();
	$(".member_thumbnail").height(156);
}




/* end new team page script */


});
	
</script>