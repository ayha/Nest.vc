<?php get_header(); ?>

<div class="main-wrapper">


	<div class="content video-container"  >
	    <div class="row">
	        <h1 style="margin: 25px 0px; height: 30px" ><img class="size-full wp-image-66 aligncenter" src="http://nest.vc/wp-content/uploads/2014/07/discover-nest.png" /><span style="visibility:hidden">Discover NEST</span></h1>
	      	<div>
	      	<div class="nest_intro_video">
		      	<span style="height: 300px;">
		           <iframe style="border: 0; padding: 0; width: 100%;" height="300" src="//www.youtube.com/embed/PmS9DRZlzC4?rel=0" frameborder="0" allowfullscreen></iframe>
		       </span>  
		       <h3>Don't have the time to read our website?</h3>
		       <p>Learn about NEST in this 2 minute video.</p>
		    </div>
		    <div class="latest_news">
		    	<ul class="news_list">
		    	<li class="news_item item" style="background-image:url(wp-content/uploads/2015/01/LondontoHK.png); background-size:cover;background-color:#f8f8f8;"><div class="news_item_overlay"><p class="news_date">News</p><h4><a href="http://nest.vc/level39-nest/" >London's Level39 and Nest join forces to support startups</a> </h4><p><a href="http://nest.vc/level39-nest/" >Find out more</a> </p></div></li>
		    	
		    	<li class="news_item item" style="background-image:url(wp-content/uploads/2014/11/aia.png); background-size:cover;background-color:#f8f8f8;"><div class="news_item_overlay"><p class="news_date">News</p><h4><a href="http://aia-accelerator.com" target="_blank">AIA joins forces with nest to offer a new breed of acceleration and support for startups in the region, no strings attached!</a> </h4> <p><a href="http://aia-accelerator.com" target="_blank">Check out AIA-accelerator.com</a> for full details on how the partnership can help your startup.</p></div></li>
		    	<li class="news_item item" style="background-image:url(wp-content/uploads/2014/11/investable_logo.png); background-size:cover;background-color:#f8f8f8;"><div class="news_item_overlay"><p class="news_date">News</p><h4><a href="http://www.investable.vc" target="_blank">Investable, our equity crowd funding startup for startups, launches phase 2 of the product.</a> </h4><p><a href="http://www.investable.vc" target="_blank">Check it out at www.investable.vc</a></p></div></li>
		    	
		    	</ul>
		    </div>
		    
		    <div class="clearboth"></div>
		    </div>
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
