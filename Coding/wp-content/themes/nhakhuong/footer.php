	<footer id="footer">
		<section class="footer padding_top_50 padding_bottom_100">			
			<div class="row">
				<div class="container">
					<div class="wrapper">
						<div class="copyright text_align_center">
							<span><?php echo get_field('copyright', 'option');?></span>
						</div>
						<div class="social_footer">
							<ul class="social_footer_ul text_align_center">
								<li><a class="icon face" href="<?php echo get_field('facebook', 'option');?>" title="" target="_bank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a class="icon twitter" href="<?php echo get_field('twitter', 'option');?>" title="" target="_bank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a class="icon google-plus" href="<?php echo get_field('rss', 'option');?>" title="" target="_bank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="clear"></div>
						<div class="developer"><a href="http://phanthaison.xyz/" target="_blank">Developer by phanthaisonth08a@gmail.com</a></div>
					</div>
				</div>
			</div>
		</section>
	</footer>
</div><!--end website-->

<?php 
$post_type_banner_ads = 'banner-ads';
$param_popup = array(
	'posts_per_page'=> 1,
	'meta_key' 		=> 'order',
	'orderby' 		=> 'meta_value_num',
	'order' 		=> 'desc',
	'meta_query'=> array(
		array(
			'key' 		=> 'ads_location',
			'value' 	=> 'popup',
			'compare' 	=> '='
		)
	)
);
$get_post_banner_ads = getPosts($post_type_banner_ads, $param_popup);
if (!empty($get_post_banner_ads)) {
	foreach ($get_post_banner_ads as $key => $post_ads) {
		$postID = $post_ads->ID;
		$get_field_URL = get_field('link_url', $postID);
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'large', true );
?>	
<div id="popup" style="display: none;">
	<div class="banner_ads_popup">
		<div class="timeout_clock">
			Popup tự tắt sau <span id="s_val"></span> giây
		</div>
		<a href="<?php echo $get_field_URL; ?>" title="<?php echo $post_ads->post_title; ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" alt="<?php echo $post_ads->post_title; ?>"></a>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var cookie_close_popup = $.cookie('close_popup');
		if (typeof cookie_close_popup == 'undefined' || cookie_close_popup == "") {
			$.fancybox({
				content: $('#popup .banner_ads_popup'), 
				openEffect  : 'elastic',
				closeEffect : 'elastic',
				closeBtn: true,
				maxWidth: 900,
				maxHeight: 600,
				helpers: {
					overlay: {
						closeClick: false
					}
				},
				afterShow: function(){
				 	// $(".fancybox-close").addClass("popup_ads");
				},
				afterClose: function() {
					$.cookie('close_popup', true, { expires: 0.1, path: '/' });
					console.log($.cookie('close_popup'));
				}
			});
		};
		start_countdown(30, '#s_val', function() { $.fancybox.close(); });
		// setTimeout(function() { $.fancybox.close(); }, 21*1000);		
	});
</script>
<?php 
	}
} 
?>

<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/lib/jquery/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/lib/jquery/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/lib/owl-carousel/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/lib/fancybox/jquery.fancybox.js?v=2.1.5"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="<?php echo TEMPLATE_URL;?>/js/html5shiv.min.js"></script>
  <script src="<?php echo TEMPLATE_URL;?>/js/respond.min.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--begin js accordion menu reponsive-->
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/accordion.cookieok.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/accordion.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/accordion.dcjqaccordion.2.9.js"></script> 
<!--end js accordion menu reponsive-->

<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/main.js"></script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1636232139975201";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52328f56491765b1"></script> -->
<?php wp_footer();?>
</body>
</html>