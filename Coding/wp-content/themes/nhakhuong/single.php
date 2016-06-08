<?php get_header();?>

<div id="primary" class="">
	<div class="wrap_primary">
		<div class="content padding_none">
<?php 
	if(have_posts()){ 
		$post_id= get_the_id();
		$currentObject = get_queried_object();
		$postType = $currentObject->post_type;
?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="row">
				<div class="detail_post">
					<?php get_template_part( 'content', 'single' );?>
					<div class="navigation">
						<div class="prev-post">	
							<?php previous_post('&laquo;&laquo; %', '', 'yes'); ?>
						</div>	
						<div class="next-post">
							<?php next_post('% &raquo;&raquo; ', '', 'yes'); ?>
						</div>
					</div>
				</div><!--End detail_post-->
			</div><!--End row-->
			
			<div class="tags_detail">			
				<img src="<?php echo TEMPLATE_URL;?>/images/icon-tags.png" alt="tags">
				<?php the_tags(); ?>
			</div>

			<?php get_template_part( 'content', 'social-share' ); ?>

			<?php if (is_single() && $postType != 'post') { ?>
			<div class="row">
				<div class="customers_comment">
					<div class="row_top">
						<h5>Bình luận</h5><span class="bg_right"></span>
						<a herf="javascript:;" id="see_all_comment" class="see_all">Xem tất cả bình luận »</a>
					</div>
					<div class="row_content">
						<div class="content">
							<div class="comment">
							<?php comments_template(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="row">
				<div class="row_top">
					<h4>Bài viết liên quan</h4><span class="bg_right"></span>
				</div>
				<div class="row_content">
					<div class="list_article list_horizontal">
						<ul class="list_article_ul">
						<?php 
						$get_post = get_post($post_id);
						$currentObject = get_queried_object();
						$postType = $currentObject->post_type;
						$taxonomy = '';
						if ($postType == 'post') {
							$taxonomy = 'category';
						} elseif ($postType == 'tin-tuc') {
							$taxonomy = 'danh-muc-tin-tuc';
						}
						// $taxonomy = get_post_taxonomies($get_post);
						$getTerm = getTermsByPost($post_id, $taxonomy);
						$termID = $getTerm[0]->term_id;
						$params = array(	
							'posts_per_page'	=> 6,
							'orderby'          	=> 'rand',
							// 'order'            	=> 'DESC',
							'exclude' 			=> $post_id
						);

						$allPosts = getPostByTerm($postType, $taxonomy, $termID, $params);
						if($allPosts) {
							foreach ($allPosts as $post) {
								setup_postdata( $post );
								$display_none = 1;
								// the_title();
								// echo "<br>";
						?>
						<li class="item list_small">
							<?php get_template_part( 'content', '' ); ?>
						</li>
						<?php
							}
							wp_reset_postdata();
						}	
						?>
						</ul>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
<?php 
	} else {
		get_template_part( 'content', 'none' );
	}
?>
		</div><!--end content-->
	</div><!--end wrap-->
</div><!--end primary-->

<?php get_sidebar();?>
<?php get_footer();?>