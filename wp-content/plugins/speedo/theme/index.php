<?php
/**
 * The Header for SPEEDO theme.
 * @package WordPress
 */
include('header.php'); ?>

<!-- DIV #WRAPPER START -->
<div id="wrapper">

    <!-- DIV .SIDEBAR LEFT START -->
	<div class="sidebarLeft ar fl">
    
		<?php if( get_option(prefix.'logoimg') != '' ) { ?>
        <!-- div .logo start -->
        <div id="logo" class="ar fr">
            <img src="<?php $logoimg= get_option(prefix.'logoimg'); echo stripslashes($logoimg); ?>" alt="" />
        </div>
        <?php } else { ?>
        <div id="logo" class="ar fr">
            <div class="txt1"><?php if( get_option(prefix.'logotext1') ) { ?><?php $logo_text1= get_option(prefix.'logotext1'); echo stripslashes($logo_text1); ?><?php } else { ?>speedo<?php } ?></div>
            <div class="txt2 lineL"><?php if( get_option(prefix.'logotext2') ) { ?><?php $logo_text2= get_option(prefix.'logotext2'); echo stripslashes($logo_text2); ?><?php } else { ?>LAUNCH<?php } ?></div>
        </div>
        <!-- div .logo end -->
        <?php } ?>
        
        <!-- div .widget start -->                        
        <div class="widget">
        
            <div id="countdown"></div><!-- div #countdown start/end -->
            
        </div>
        <!-- div .widget end -->
        
        <!-- div #progress_container start -->                        
        <div id="progress_container">
        
            <div class="progressbar" id="progress"></div><!-- div .progressbar start/end -->
            
        </div>
        <!-- div #progress_container end --> 
        
	</div>
    <!-- DIV .SIDEBAR LEFT END -->

    <!-- DIV .MAINCONTENT START -->
	<div class="maincontent ac fl">
    
        <div id="speedometer"></div><!-- div #speedometer start/end -->
        
        <h3 class="main-msg1"><?php if( get_option(prefix.'main_msg1') != '' ) { ?><?php $main_msg1= get_option(prefix.'main_msg1'); echo stripslashes($main_msg1); ?><?php } else { ?>UNDER<?php } ?></h3>
        <h1 class="main-msg2"><?php if( get_option(prefix.'main_msg2') != '' ) { ?><?php $main_msg2= get_option(prefix.'main_msg2'); echo stripslashes($main_msg2); ?><?php } else { ?>CONSTRUCTION<?php } ?></h1>
        
        <!-- div #twitterUserTimeline start -->
		<?php if( get_option(prefix.'twitter') ) { ?>            	
        <div id="twitterUserTimeline" class="tweets"></div>
		<?php } ?>            	
        <!-- div #twitterUserTimeline end -->
        
        <div class="clear"></div><!-- IMPORTANT -->
        
        <!-- div #footer start -->
        <div id="footer">
            <!-- div #menu start -->                        
            <div id="menu" class="ac">
                <ul>
                    <li class="info"><a rel="popuprel-1" class="popup" title="about us" href="#"></a></li>
                    <li class="contact"><a rel="popuprel-2" class="popup" title="contact" href="#"></a></li>
					<?php if( get_option(prefix.'twitter') ) { ?>            	
                    <li class="tweeturl"><a title="twitter" href="http://twitter.com/<?php $twitter = get_option(prefix.'twitter'); echo stripslashes($twitter); ?>" target="_blank"></a></li>
                    <?php } ?>
					<?php if( get_option(prefix.'facebook') ) { ?>            	
                    <li class="fburl"><a title="facebook" href="<?php $facebook = get_option(prefix.'facebook'); echo stripslashes($facebook); ?>" target="_blank"></a></li>
                    <?php } ?>
                </ul>
            </div>
            <!-- div #menu end -->                        
        </div>
        <!-- div #footer end -->
        
	</div>
    <!-- DIV .MAINCONTENT END -->
    
    <!-- DIV .SIDEBARRIGHT-1 START -->
	<div class="sidebarRight fr">
    
        <!-- div .label start -->
        <div class="label">
            <div class="txt1"><?php if( get_option(prefix.'scb_label1') ) { ?><?php $scb_label1= get_option(prefix.'scb_label1'); echo stripslashes($scb_label1); ?><?php } else { ?>stay<?php } ?></div>
            <div class="txt2 lineR"><?php if( get_option(prefix.'scb_label2') ) { ?><?php $scb_label2= get_option(prefix.'scb_label2'); echo stripslashes($scb_label2); ?><?php } else { ?>UPDATED<?php } ?></div>
        </div>
        <!-- div .label end -->
    
        <!-- div .widget start -->                        
        <div class="widget">
        
            <p><?php if( get_option(prefix.'scb_msg') ) { ?><?php $scb_msg= get_option(prefix.'scb_msg'); echo stripslashes($scb_msg); ?><?php } else { ?>Enter your email address to get notified when we are ready<?php } ?></p>
        
			<?php if( get_option(prefix.'scb_mtd') == 'FeedBurner Service' ) { ?>
            <!-- Feedburner Subscribers Form Start -->
            <form style="width: auto;height: 24px;padding: 3px;margin: 10px auto 0;float: left;background: #1a1a1a;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php $feedburner = get_option(prefix.'feedburner'); echo stripslashes($feedburner); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input type="text" class="subscriberInput" onfocus="if (this.value == 'Enter your email address') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter your email address';}" name="email"/>
            <input type="hidden" value="<?php $feedburner = get_option(prefix.'feedburner'); echo stripslashes($feedburner); ?>" name="uri"/>
            <input type="hidden" name="loc" value="en_US"/>
            <input type="submit" class="subscriberButton" value="GO!" />
            </form>
            <div class="clear"></div>
            <!-- Feedburner Subscribers Form End -->        
			<?php } elseif( get_option(prefix.'scb_mtd') != 'FeedBurner Service' || get_option(prefix.'scb_mtd') == '' ) { ?> 
            <!-- Basic Subscribers Form Start -->
            <form action="<?php if( get_option(prefix.'scb_mtd') == 'Basic Process' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber.php<?php } elseif( get_option(prefix.'scb_mtd') == 'Send to My Email' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber-mail.php<?php } elseif( get_option(prefix.'scb_mtd') == 'Send to My Gmail' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber-gmail.php<?php } else { ?><?php echo SPEEDO_THEME_DIR; ?>/subscriber.php<?php } ?>" method="post" class="subscriberForm">
                <input type="text" name="email" id="email" class="subscriberInput" value="" onFocus="if (this.value == 'Enter your email address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter your email address';}" />
                <input type="submit" class="subscriberButton" value="GO!" />
            </form>
            
            <div class="clear"></div>
            <div class="loader"><img src="<?php echo SPEEDO_THEME_IMG; ?>/loader.gif" alt="loading" /></div>
            <div id="submessage"><div id="warning"></div></div>
            <!-- Basic Subscribers Form End --> 
			<?php } ?>
        
        </div>
        <!-- div .widget end -->
        
	</div>
    <!-- DIV .SIDEBAR-RIGHT END -->

<div class="clear"></div><!-- IMPORTANT -->

</div>
<!-- DIV #WRAPPER END -->

<!-- div .popupbox-1 start -->
<div class="popupbox-1" id="popuprel-1">

    <a href="<?php bloginfo('url'); ?>" class="close" title="close"></a><!-- close button start/end -->
    
    <!-- div .popContent start -->
    <div class="popContent">
    
        <!-- div .insidePop-L start -->
    	<div class="insidePop-L fl">
        
        <h1><?php if( get_option(prefix.'info_ttl') ) { ?><?php $info_ttl= get_option(prefix.'info_ttl'); echo stripslashes($info_ttl); ?><?php } else { ?>Who We Are..?<?php } ?></h1>
        
        <!-- div .thecontent start -->
        <div class="thecontent">
			<?php if( get_option(prefix.'info_main') != '' ) { ?>
            <?php $info_main= get_option(prefix.'info_main'); echo stripslashes($info_main); ?>
            <?php } else { ?>
            <p><img class="alignleft" src="./images/sample/thumbnail.png" alt="Your Picture" />This is an example of information page for your website. If you are using Speedo WordPress plugin version you can replace this default content with your own from theme option panel. Most people start with an information that introduces them to potential site visitors. It might say something like this :</p>
            <blockquote><p>Hi there! I'm a web designer by day and night, and this is my Amazing Site. I live in Some City, have a great place, and I like pina coladas. (And gettin' caught in the rain.)</p></blockquote>
            <p>…or something like this:</p>
            <blockquote><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickies to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
            <?php } ?>
        </div>
        <!-- div .thecontent end -->
        
        <div class="clear"></div><!-- IMPORTANT -->
        
        </div>
        <!-- div .insidePop-L end -->
        
        <!-- div .insidePop-R start -->
    	<div class="insidePop-R fr">
			<?php if( get_option(prefix.'info_side') != '' ) { ?>
            <?php $info_side= get_option(prefix.'info_side'); echo stripslashes($info_side); ?>
            <?php } else { ?>
            <h2>Hello World..!</h2>
            <p>Vivamus fermentum interdum justo, vitae mattis justo mattis id. Praesent enim tellus; tempus ut imperdiet sodales, mollis id tortor. Morbi ut ultricies lacus. Sed sollicitudin, nibh sit amet vulputate mollis, urna augue tristique nisi, bibendum dictum justo ante vel arcu? Vivamus mollis lacinia odio, quis venenatis erat convallis at. Aliquam tincidunt, tellus sed egestas feugiat, urna dui posuere lacus, ac euismod neque sapien vel arcu. Nunc a iaculis metus vero accusamus dignissimos.</p>
            <h3>Information</h3>
            <p><span class="bold">Office :</span> 123 Main Street, City, Country<br />
            <span class="bold">Phone :</span> 1 700 777 7000<br />
            <span class="bold">Mobile :</span> +17 700 0000 7777<br />
            <span class="bold">eMail :</span> support@yoursite.com</p>
            <?php } ?>
        </div>
        <!-- div .insidePop-R end -->
        
        <div class="clear"></div><!-- IMPORTANT -->
        
    </div>
    <!-- div .popContent end -->
    
</div>
<!-- div .popupbox-1 end -->

<!-- div .popupbox-2 start -->
<div class="popupbox-2" id="popuprel-2">

    <a href="<?php bloginfo('url'); ?>" class="close" title="close"></a><!-- close button start/end -->
    
    <!-- div .popContent start -->
    <div class="popContent">
    
		<?php if( get_option(prefix.'cp_ttl') != '' ) { ?>
        <h1><?php $cp_ttl= get_option(prefix.'cp_ttl'); echo stripslashes($cp_ttl); ?></h1>
		<?php } else { ?>    
        <h1>Contact Support</h1>
        <?php } ?>
        
        <!-- div .thecontent start -->
        <div class="thecontent">
			<?php if( get_option(prefix.'cp_msg') != '' ) { ?>
            <p><?php $cp_msg= get_option(prefix.'cp_msg'); echo stripslashes($cp_msg); ?></p>
			<?php } else { ?>    
            <p>If you need more information about our company or you need assistance, support or help for our products, please contact us via our contact form below. We would also appreciate any feedback and We'll get back to you as soon as possible. Thanks!</p>
            <?php } ?>
            
            <div class="message"><div id="alert"></div></div><!-- AJAX div .message and .alert start/end -->
            
            <!-- div #contactForm start -->
            <form action="<?php if( get_option(prefix.'mail_process') == 'Basic Process' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail.php<?php } elseif( get_option(prefix.'mail_process') == 'Gmail SMTP' ) { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail-smtp.php<?php } else { ?><?php echo SPEEDO_THEME_DIR; ?>/sendmail.php<?php } ?>" method="post" id="contactForm">
                
                <div>
                <label for="name">Name:</label>
                <input type="text" name="name" value="" id="name" class="input" />
                </div>
                <div>
                <label for="mail">Email:</label>
                <input type="text" name="mail" value="" id="mail" class="input" />
                </div>
                <div>
                <label for="subject">Subject:</label>
                <input type="text" name="subject" value="" id="subject" class="input" />
                </div>
                <div class="bot">
                <label for="last">Bot:</label>
                <input type="text" name="last" value="" id="last" class="input" />
                </div>
                <div>
                <label>Message:</label>
                <textarea rows="10" name="message" id="message"></textarea>
                </div>
                <input type="submit" value="Send" id="sendbutton" class="button" />
                <input type="reset" value="Clear" id="clearbutton" class="button" />
                <div class="process"><img src="<?php echo SPEEDO_THEME_IMG; ?>/loader.gif" alt="" class="loading" /></div>
            
            </form>
            <!-- div #contactForm end -->
            
        <div class="clear"></div><!-- IMPORTANT -->
            
        </div>
        <!-- div .thecontent end -->

    </div>
    <!-- div .popContent end -->
    
</div>
<!-- div .popupbox-2 end -->

<?php include('footer.php'); ?>
