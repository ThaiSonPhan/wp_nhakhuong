/*menu responsive*/
$(function() {
	// var pull = $('.btn_pull');
	// menu = $('.nav_responsive > ul');
	// menuHeight  = menu.height();
	$('.btn_pull').on('click', function(e) {
		pr('click');
		e.preventDefault();
		// menu = $('.nav_responsive > ul');
		// menuHeight  = menu.height();
		$('#accordion').slideToggle();
	});
});
$(document).ready(function() {
	$('#accordion').dcAccordion({
		eventType: 'click',
		autoClose: true,
		saveState: true,
		disableLink: true,
		hoverDelay: 100,
		showCount: false,
		speed: 'medium'
	});
}),jQuery();

/*Back to top*/
$(document).ready(function() {
	$('body').append('<div id="backtotop" title="Lên đầu trang">Back to Top</div>');
	$(window).scroll(function() {
		if($(window).scrollTop() >= 600) {
			$('#backtotop').fadeIn();
		} else {
			$('#backtotop').fadeOut();
		}
	});
	$('#backtotop').click(function() {
		$('html, body').animate({scrollTop:0},500);
   	});
});

/* Menu top scrool 
$(document).ready(function() 
{	
	$(window).scroll(function() 
	{
		if ($(window).width() >= 950) 
		{
			var topNav = $("#nav").offset().top+0;
			if($(window).scrollTop() > topNav) 
			{
				$('#nav-fixed').fadeIn(200);
			} 
			else 
			{
				$('#nav-fixed').fadeOut(50);
			}
    	}
	});
});*/

/*Dropdown menu*/
$(document).ready(function() {
    $("#nav.nav ul.nav_ul li").hover(function() {
        $(this).find("ul:first").css({
            visibility: "visible",
            display: "none"
        }).slideDown(300)
    }, function() {
        $(this).find("ul:first").css({
            visibility: "hidden"
        })
    })
})

/* owl slider*/
$(document).ready(function() { 
  	var owl_slider = $("#owl-slider");
  	owl_slider.owlCarousel({
 		autoPlay : 5000,
 		stopOnHover : true,
 		slideSpeed : 1000,
 		paginationSpeed : 1000,
	    goToFirstSpeed : 2000,
	    singleItem : true,
	    autoHeight : true,
	    pagination : true,
      	navigation : false,
      	navigationText : false,
      	transitionStyle : "fade" /*fade, backSlide, goDown , fadeUp*/
  	});

	var owl_testimonial = $(".testimonial_slide");
		owl_testimonial.owlCarousel({
		autoPlay : 3000,
		stopOnHover : true,
		slideSpeed : 1000,
		paginationSpeed : 1000,
		goToFirstSpeed : 2000,
		singleItem : true,
		autoHeight : true,
		pagination : true,
		navigation : false,
		navigationText : false,
		transitionStyle : "backSlide" /*fade, backSlide, goDown , fadeUp*/
	});
});

/*js kiem tra ton tai img sau do add class lazy
$(document).ready(function(){
	$.each($("#primary img"),function(){ 
		if(!$(this).hasClass("lazy")){
		var src=$(this).attr("src");
		var src_new=TEMPLATE_URL+"/images/icon-loading.gif";
		var width = $(this).width();
		var height = $(this).height();
		$(this).attr("data-src",src);
		$(this).attr("src",src_new);
		$(this).attr("width",width);
		$(this).attr("height",height);
		$(this).addClass("lazy");
		}
	});
});*/

/* Lazy image loading */
$(document).ready(function() {
	if($("img.lazy").length > 0){
		$("img.lazy").lazy({
			fallbackWidth   : $( window ).width(),
			fallbackHeight  : $( window ).height(),
			effect: "fadeIn",
			effectTime: 500
		});
	}
});

/* Đồng hồ đếm ngược */
var s = null; // Giây	 
var timeout = null; // Timeout
function start_countdown(time, id_show, callback) {
	if (s == null)
	{
		s = parseInt(time);
	}
	// console.log(s);
	if (s == 0){
		clearTimeout(timeout);
		// alert('Hết giờ');
		if (callback && typeof callback == 'function') {
			callback();
		};
		return false;
	}

	$(id_show).text(s);

	timeout = setTimeout(function(){
		s--;
		start_countdown(s, id_show, callback);
	}, 1000);
}
function stop_countdown(){
	clearTimeout(timeout);
}


/*function onShare(type, ele, url) {
var left = (screen.width / 2) - (600 / 2);
var top = (screen.height / 2) - (600 / 2);
window.open($(ele).data('href') + url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,left=' + left + ',top=' + top);
return false;
};*/