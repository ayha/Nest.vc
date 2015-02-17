var isScrolling = false;
var titleOffset = -80;
var sectionPositions = new Array();
var currentSection = "home";
$(document).ready(function(){
	$(".faq_section").each(function(ele){
		//console.log($(this));
		if(!$(this).hasClass("active")){
			$(this).children(".faq_list").hide();
		}
	});
	
	$(".faq_section h3").click(function(e){
		e.preventDefault();
		$(this).parent().toggleClass("active");
		if($(this).parent().hasClass("active")){
			$(this).parent().children(".faq_list").show(500);
		}else{
			$(this).parent().children(".faq_list").hide(500);
		}
	});
	
	$("section").each(function(ele){
		var object = {"title": $(this).attr("id"), "top":$(this).offset().top};
		sectionPositions.push(object);
	});
	
	//console.log(sectionPositions);
	
	$(window).scroll(function(e){
		//console.log($(window).scrollTop());
		onPageScroll();
	});
	
	$(".nav li a.navlink, .contentlink").on("click", function(e){
		e.preventDefault();
		var goto = $(this).data("section");
		var newTop = $("#"+goto).offset().top+titleOffset+10;
		//console.log(goto + " / " + $("#"+goto).offset());
		$('html, body').animate({scrollTop: newTop}, 800);
		$(".navbar-collapse").removeClass("in");
	});
	
	setupSideNav();
	
});


function setupSideNav(){
	
	$(".navbar .navbar-nav").children().each(function(ele){
		
		if(!$(this).children("a").hasClass("homelink") && !$(this).children("a").hasClass("applynow")){
			
			$(this).clone(true).appendTo($("#sidenav").children(".nav"));
		}
		
		$("#sidenav").children(".nav").children("li").removeClass();
	});
	
}


function onPageScroll(){
	
	var currentScroll = $(window).scrollTop();
	
	for(var i=0; i<sectionPositions.length; i++){	
		if(currentScroll > (sectionPositions[i].top+titleOffset)){
			currentSection = sectionPositions[i].title;
		}
	}

	
	$("#sidenav ul.nav li a").removeClass("active");
	$("#sidenav ul.nav li a[data-section="+currentSection+"]").addClass("active");
}
