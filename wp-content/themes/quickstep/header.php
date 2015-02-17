<!DOCTYPE html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<!--[if lt IE 9]>
    <script type="text/javascript">
         document.createElement('header');
         document.createElement('hgroup');
         document.createElement('nav');
         document.createElement('menu');
         document.createElement('section');
         document.createElement('article');
         document.createElement('aside');
         document.createElement('footer');
    </script>
<![endif]-->
	
	<head>
		<meta charset="utf-8">
                <!--[if IE 8 ]><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"><![endif]-->
                <meta name="google-site-verification" content="fPNFXeQFVV20FL-pyE_h70Y_2woy-IOUTyt-OchTHZA" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                 
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '-', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'qs_framework' ), max( $paged, $page ) );
		?></title>
        
		
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Nest joins forces with AIA to offer a new breed of acceleration and support for startups in the region, no strings attached! We invest seed capital and time in promising scalable startups. Our team of dedicated startup experts empower founders worldwide with our strengths in marketing, strategy, and access to global industry networks from our headquarters in the heart of Asia – Hong Kong. We also help startups with next round growth, further fund raising and new market expansion. Having all built a series of businesses, our team is well placed to help entrepreneurs succeed.">
		<meta name="keywords" content="Nest.vc,Nest Investments,Nest HK, Nest Hong Kong, Startups Hong Kong">
		
		<meta name="author" content="Nest.vc">
		
		<?php if( of_get_option('qs_favicon') ): ?>
            <link rel="icon" type="image/png" href="<?php echo of_get_option('qs_favicon'); ?>">
        <?php endif; ?>

		<!-- default stylesheet -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/normalize.css">		      
		
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
   
        
            <!-- wordpress head functions -->
            <?php wp_head(); ?>
            <!-- end of wordpress head -->        
			
			     
        <link href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.min.js"></script>


<link href="<?php echo get_template_directory_uri(); ?>/js/thumbnail_grid/default.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/js/thumbnail_grid/component.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/thumbnail_grid/modernizr.custom.js"></script>		
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/thumbnail_grid/grid.js"></script>		

			
	</head>
	
	<body <?php body_class(); ?>>
	

			
          
			<header role="banner">
			
            	<div id="header-bg"></div>
            	
				<div id="inner-header" class="wrapper clearfix">
					
                    <div class="row">
                    
                    	<div class="twelve columns">
                            <!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
                            <div id="logo" class="h1">
                            	<span><a href="<?php echo home_url(); ?>" rel="nofollow">
									<?php if(of_get_option('qs_logo')): ?>
                                        <img src="<?php echo of_get_option('qs_logo'); ?>" alt="<?php bloginfo('name'); ?>" />
                                    <?php else: ?>
                                        <span id="blog-name"><?php bloginfo('name'); ?></span>
                                    <?php endif; ?>
                                    </a>
                              	</span>
                            </div>

<div class="header_social">
	<a href="https://www.facebook.com/nestideas" target="blank"><img src="http://nest.vc/wp-content/uploads/2013/09/foot-social-icons-1fb.png" width="20" height="21" border="0" style="margin-right:1px"></a>
    <a href="https://twitter.com/NESTHongKong" target="blank"><img src="http://nest.vc/wp-content/uploads/2013/09/foot-social-icons-2tw.png" width="20" height="21" border="0" style="margin-right:1px"></a>
    <a href="http://www.linkedin.com/company/2008127" target="blank"><img src="http://nest.vc/wp-content/uploads/2013/09/foot-social-icons-3in.png" width="20" height="21" border="0" style="margin-right:1px"></a>
    <a href="http://weibo.com/nestideas" target="blank"><img src="http://nest.vc/wp-content/uploads/2013/09/foot-social-icons-4wb.png" width="20" height="21" border="0" style="margin-right:1px"></a>
    <a href="https://plus.google.com/+Nestideas" target="blank"><img src="http://nest.vc/wp-content/uploads/2013/11/gplus-icon.png" width="20" height="21" border="0" style="margin-right:1px"></a>
	 <a href="https://www.youtube.com/channel/UCfMGvkuSnLws-42JmpHyLWA" target="blank"><img src="http://nest.vc/wp-content/uploads/2014/11/foot-social-icons-1yt.png" width="20" height="21" border="0" style="margin-right:1px"></a>
	<a target="blank" href="http://angel.co/nest-investments" title="AngelList Nest Investments"><img src="http://nest.vc/wp-content/uploads/2014/07/foot-social-icons-1angel.png" style="margin-right:1px" /></a>
	
</div>

                            <!-- if you'd like to use the site description you can un-comment it below -->
                            <?php // bloginfo('description'); ?>
                            
                            
                            
                            <div class='menu-button'></div>	
                            <nav role="navigation">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new qs_walker(), 'items_wrap'      => '<ul id="nav" class="%2$s sf-menu sf-js-enabled">%3$s</ul>', ) ); 
                                }
                                else {
                                    theme_nav();
                                }
                                 ?>
                            </nav>
                            
                    	</div>
                    
                    </div>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
		
	    		
