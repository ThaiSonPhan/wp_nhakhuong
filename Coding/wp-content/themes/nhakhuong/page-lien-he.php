<?php get_header();?>

<div id="primary" class="width_full">
	<div class="wrap_primary">
		<div class="content padding_none">
<?php 
	if(have_posts()){ 
		$post_id= get_the_id();
?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="row_top">
					<h2><?php the_title(); ?></h2><span class="bg_right"></span>
				</div>
				<div class="row_content">
					<div class="left form_contact">
						<?php the_content(); ?>
					</div>
					<div class="right info_contact">
						<div class="content">
							<h2 class="OptimaRegular"><?php echo get_field('company', 'option');?></h2>
							Địa chỉ: <?php echo get_field('address', 'option');?><br>
							Điện thoại: <?php echo get_field('phone', 'option');?> - Fax: <?php echo get_field('fax', 'option');?><br>
							Email: <a href="mailto:<?php echo get_field('email', 'option');?>"><?php echo get_field('email', 'option');?></a><br>
							Website: <u style="color:#fa2200;"><b><i><a style="color:#fa2200;" href="<?php echo get_field('website', 'option');?>"><?php echo get_field('website', 'option');?></a></i></b></u>
						</div>
						<div class="maps">
							<?php 
								$location = get_field('maps', 'option');
								if( !empty($location) ):
								?>
								<div class="acf-map">
									<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</article>
			<div class="clear"></div>
		<?php endwhile; ?>
<?php 
	} else {
		get_template_part( 'content', 'none' );
	}
?>
		</div><!--end content-->
	</div><!--end wrap-->
</div><!--end primary-->
<style type="text/css" media="screen">
	.acf-map {
		width: 100%;
		height: 470px;
		margin: 20px 0;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/google-maps.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/form-contact.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/validate.css" /> 
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>/js/jquery.validate.js"></script>	
<script type="text/javascript">	
$(document).ready(function() {	
		$("#ContactForm").validate({
			rules: {
				"your-name": {
					required: true,
					maxlength: 30,
				},
				"your-phone": {
					required: true,
					number: true,
					minlength: 10,
					maxlength: 11,
				},
				"your-email": {
					required: true,
					email: true
				},
				"your-subject": {
					required: true,
					maxlength: 100,
				},
				"your-message": {
					required: true,
					maxlength: 500,
				}
			},
			messages: {
				"your-name": {
					required: "Vui lòng nhập tên đầy đủ của bạn",
					maxlength: "Đặt tên cho tối đa 30 ký tự"
				},
				"your-phone": {
					required: "Vui lòng nhập số điện thoại của bạn",
					number: "Vui lòng nhập các con số",
					minlength: "Số điện thoại phải có 10 số",
					maxlength: "Số điện thoại lên đến 11 số"
				},
				"your-email": {
					required: "Vui lòng nhập email của bạn",
					email: "Vui lòng nhập một định dạng email hợp lệ. ví dụ như email@examples.com"
				},
				"your-subject": {
					required: "Vui lòng nhập tiêu đề",
					maxlength: "Tối đa 100 ký tự cho tiêu đề"
				},
				"your-message": {
					required: "Vui lòng nhập nội dung",
					maxlength: "Tin nhắn tối đa 500 ký tự"
				}
			}
		});
		$(document).on('click', '#submit_form', function(event) {
		
			if(!$('#ContactForm').valid()) {
				return false;
			}
		});
});	
</script>
<?php get_footer();?>