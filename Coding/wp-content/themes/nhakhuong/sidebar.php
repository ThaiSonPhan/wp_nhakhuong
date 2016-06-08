<div id="sidebar" class="right">

	<div class="row">
		<div class="category_product">					
			<ul class="primary_menu">
				<?php
					$params_danh_muc_san_pham = array(
						'parent'			=> 0,
						'meta_key' 		=> 'order',
						'orderby' 		=> 'meta_value_num',
						'order' 		=> 'asc',
					);

					$getTerm_san_pham  = getTermsByTaxonomy('danh-muc-san-pham', $params_danh_muc_san_pham, true);

					if(!empty($getTerm_san_pham)) {
						$allTermArr = array();
						foreach ( $getTerm_san_pham as $key => $Term_san_pham) {
						    $order = get_field( 'order', $Term_san_pham );
						    if(array_key_exists($order,  $allTermArr))
								$order = max(array_keys($allTermArr)) + 1;
						    $allTermArr[$order] = $Term_san_pham;

						    // $allTermArr[] = $Term_san_pham->name;//sort name ABC
						}
						krsort($allTermArr, SORT_NUMERIC);

						foreach ($allTermArr as $key => $terms) {
							setup_postdata( $terms );
							$post_id= get_the_id();
							$term_link = get_term_link( $terms );
				?>
				<li><a href="<?php echo $term_link ?>" title=""><?php echo $terms->name; ?></a>
					<?php
						// pr($terms);
						$params_term_parent = array(
						    'parent'		=> $terms->term_id,
							'meta_key' 		=> 'order',
							'orderby' 		=> 'meta_value_num',
							'order' 		=> 'asc'
						); 
						$terms_parent = getTermsByTaxonomy($terms->taxonomy, $params_term_parent, true);
						// pr($terms_parent,1);
					?>
					<ul class="sub_menu attractions_parent_<?php echo $terms->term_id;?>">
					<?php
						if(!empty($terms_parent)) {
							foreach ($terms_parent as $key => $term) {
								setup_postdata( $term );
								$term_link = get_term_link( $term );
					?>
						<li><a href="<?php echo $term_link?>" title=""><?php echo $term->name; ?></a></li>
					<?php
							}
							wp_reset_postdata();
						}
					?>
					</ul>
				</li>
				<?php
						}
						wp_reset_postdata();
					}
				?>
			</ul><!-- END primary_menu -->
		</div><!-- category_product -->
	</div><!-- End row category -->


	<?php 
	$post_type_banner_ads = 'banner-ads';
	$param_top_sidebar = array(
		'posts_per_page'=> 6,
		'meta_key' 		=> 'order',
		'orderby' 		=> 'meta_value_num',
		'order' 		=> 'desc',
		'meta_query'=> array(
			array(
				'key' 		=> 'ads_location',
				'value' 	=> 'top_sidebar',
				'compare' 	=> '='
			)
		)
	);
	$get_post_banner_ads = getPosts($post_type_banner_ads, $param_top_sidebar);
	if (!empty($get_post_banner_ads)) {
		foreach ($get_post_banner_ads as $key => $post_ads) {
			$postID = $post_ads->ID;
			$get_field_URL = get_field('link_url', $postID);
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'medium', true );
	?>	
	<div class="row">
		<div class="banner_ads_sidebar">
			<a href="<?php echo $get_field_URL; ?>" title="<?php echo $post_ads->post_title; ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" alt="<?php echo $post_ads->post_title; ?>"></a>
		</div>
	</div>
	<?php 
		}
	} 
	?>

	<?php 
	$field_yotube = get_field('video_youtube_sidebar', 'option');
	if (!empty($field_yotube)) {
		$field_youtube_exp = explode(",", $field_yotube);
	?>
	<div class="row">
		<div class="border_line">
			<div class="row_top">
				<h3>Video</h3>
			</div>
			<?php foreach ($field_youtube_exp as $youtube) { ?>
			<div class="row_content">
				<div class="video">
					<iframe width="100%" height="180" src="https://www.youtube.com/embed/<?php echo $youtube;?>" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>	
	<?php
	}
	?>
	
	<?php 
	$post_type_banner_ads = 'banner-ads';
	$param_bottom_sidebar = array(
		'posts_per_page'=> 6,
		'meta_key' 		=> 'order',
		'orderby' 		=> 'meta_value_num',
		'order' 		=> 'desc',
		'meta_query'=> array(
			array(
				'key' 		=> 'ads_location',
				'value' 	=> 'bottom_sidebar',
				'compare' 	=> '='
			)
		)
	);
	$get_post_banner_ads = getPosts($post_type_banner_ads, $param_bottom_sidebar);
	if (!empty($get_post_banner_ads)) {
		foreach ($get_post_banner_ads as $key => $post_ads) {
			$postID = $post_ads->ID;
			$get_field_URL = get_field('link_url', $postID);
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'medium', true );
	?>	
	<div class="row">
		<div class="banner_ads_sidebar">
			<a href="<?php echo $get_field_URL; ?>" title="<?php echo $post_ads->post_title; ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" alt="<?php echo $post_ads->post_title; ?>"></a>
		</div>
	</div>
	<?php 
		}
	} 
	?>

	<div class="clear"></div>
</div><!--end sidebar-->