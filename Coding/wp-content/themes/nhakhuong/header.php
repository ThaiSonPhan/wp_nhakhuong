<?php if(!session_id()) {session_start();} ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="Content-Language" content="<?php echo get_locale() ?>">
	<meta name="Language" content="<?php echo get_locale() ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta generator="phanthaisonth08a@gmail.com">
	<meta name="author" content="<?php echo get_bloginfo( 'name' ); ?>">
	<meta name="geo.region" content="<?php echo get_locale() ?>" />
	<meta name="geo.position" content="" />
	<meta name="ICBM" content="" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php 
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (!is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) {
		genMetaSocial();
	}
	wp_head();
	?>

	<!--Favicon image-->
	<?php
	$field_favicon = get_field('favicon', 'option');
	$src_favicon = !empty( $field_favicon ) ? $field_favicon : TEMPLATE_URL.'/images/favicon.png'; 
	?>
	<link rel="shortcut icon" type="image/png" href="<?php echo esc_url( $src_favicon ) ?>") />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo TEMPLATE_URL;?>/js/html5.js"></script>
	<![endif]-->

	<!-- Core Boostrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/bootstrap/css/bootstrap.min.css"/>
	<!-- Core Font Awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/font-awesome/css/font-awesome.min.css"/>
	<!-- Core CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/font.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/general.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/dropdownmenu.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/responsive_elem.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/ddsmoothmenu-v.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/fancybox/jquery.fancybox.css?v=2.1.5"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/owl-carousel/css/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/owl-carousel/css/owl.theme.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/owl-carousel/css/owl.transitions.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/lib/owl-carousel/css/owl.mystyle.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/menu-simple-tab.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>/css/responsive.css"/>

	<script type="text/javascript">	
		var PATH_URL = '<?php bloginfo('url');?>';
		var ROOT = '<?php bloginfo('url');?>';
		var TEMPLATE_URL = '<?php bloginfo('template_url');?>';
		/*BEGIN: DEBUG*/
		function pr(message){
			if(console && console.log){
				console.log(message);
			}
		}
		/*END: DEBUG*/
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>

	<div id="website">
		<header id="header" class="site-header" role="banner">
			<div class="container">
				<div class="banner">
					<div class="col-lg-4 col-sm-6 padding_none">
						<div class="top">
							<div class="logo hidden-xs">
								<?php
								$field_logo = get_field('company_logo', 'option');
								$src_logo = !empty( $field_logo ) ? $field_logo : TEMPLATE_URL.'/images/logo-name.png'; 
								?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="img-responsive" src="<?php echo esc_url( $src_logo ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/></a>
							</div>
							<div class="logo mobile hidden-sm hidden-md hidden-lg">
								<?php
								$field_logo_mobile = get_field('company_logo_mobile', 'option');
								$src_logo_mobile = !empty( $field_logo_mobile ) ? $field_logo_mobile : TEMPLATE_URL.'/images/logo_white.png'; 
								?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="img-responsive" src="<?php echo esc_url( $src_logo_mobile ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/></a>
							</div>
							<div class="pull">
								<a href="javascript:;" class="btn_pull"><img src="<?php echo TEMPLATE_URL;?>/images/icon-nav-responsive-red.png" alt="pull"></a>					
							</div>
						</div>
						<div class="clear"></div>

						<div class="nav_responsive">
							<ul id="accordion">
								<?php
									$HeaderMenu = wp_nav_menu(array(
										'theme_location' => 'header-menu-mobile',
										'container' => '',
										'fallback_cb' => 'alert_menu',
										'items_wrap' => '%3$s',
										'echo' => true,
										'walker' => new Nav_Menu_Walker_Header
									));
								?>
							</ul>
						</div>
					</div>
					<div class="col-lg-8 col-sm-6 padding_none">
						<div class="hotline_wraper">
							<div class="face_like">
								<div class="fb-like" data-href="<?php echo esc_url( home_url( '/' ) ); ?>" data-width="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							</div>
							<?php $field_hotline = get_field('hotline', 'option'); 
							if ( !empty($field_hotline) ) {
								printf( '<div class="hotline"><span>%s</span></div>', esc_html( $field_hotline ) );
							} ?>
						</div>
						<div class="clear"></div>
					</div>
						<div id="menu_head">
							<div id="nav" class="nav">
								<ul class="nav_ul">
									<?php
										$HeaderMenu = wp_nav_menu(array(
											'theme_location' 	=> 'header-menu',
											'container' 		=> '',
											'fallback_cb' 		=> 'alert_menu',
											'items_wrap' 		=> '%3$s',
											'echo' 				=> true,
											'walker' 			=> new Nav_Menu_Walker_Header
										));
									?>
								</ul>
							</div>
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
				</div><!-- End banner -->
			</div><!--End container-->
			<div class="clear"></div>
		</header><!-- #masthead -->
		<div class="clear"></div>

		<div id="slider">
			<div id="owl-slider" class="owl-carousel owl-theme image_slide">
				<div class="item_slide">
					<a href="#" title=""><img class="img-responsive" src="<?php echo TEMPLATE_URL ?>/images/slide-01.jpg" alt="slide item"></a>
				</div>
				<div class="item_slide">
					<a href="#" title=""><img class="img-responsive" src="<?php echo TEMPLATE_URL ?>/images/slide-02.jpg" alt="slide item"></a>
				</div>
				<div class="item_slide">
					<a href="#" title=""><img class="img-responsive" src="<?php echo TEMPLATE_URL ?>/images/slide-03.jpg" alt="slide item"></a>
				</div>
			</div>
			<div class="slide_border"></div>
		</div><!--End Slider-->

		<div id="main" class="site-main">
			<?php if (!is_home()) { ?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
			    <?php if(function_exists('bcn_display'))
			    {
			        bcn_display();
			    }?>
			</div>
			<?php } ?>