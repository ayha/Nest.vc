<?php get_header(); ?>

<div class="main-wrapper">


	<div class="content video-container"  >
	    <div class="row">
	        <h1 style="margin: 25px 0px; height: 30px" ><img class="size-full wp-image-66 aligncenter" src="http://nest.vc/wp-content/uploads/2014/07/discover-nest.png" /><span style="visibility:hidden">Discover NEST</span></h1>
	      <span style="height: 400px;">
	           <iframe style="border: 0; padding: 0; width: 100%;" height="400" src="//www.youtube.com/embed/wsZEQwj4gdY" frameborder="0" allowfullscreen></iframe>
	       </span> 
	       <h3>Don't have the time to read our website?</h3>
	       <p>Learn about NEST in this 3 minute video.</p>
	    </div>
	</div>
	

<?php 
$one_page_enabled = of_get_option('qs_one_page');
if(!$one_page_enabled) :
    include_once 'includes/index-loop.php';
else:
    include_once 'includes/one-page-loop.php';
endif;
?>
    
    <div class="push"></div>
</div>
    
<div id="scroll-top">
	<a href="#top"><span></span></a>	
</div>	


<?php get_footer(); ?>
