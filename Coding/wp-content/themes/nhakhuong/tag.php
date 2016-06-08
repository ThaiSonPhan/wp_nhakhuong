<?php get_header();?>

<div id="primary" class="">
	<div class="wrap_primary">
		<div class="content list padding_none">
<?php 
	if(have_posts()){ 
?>
			<div class="row">
				<div class="row_top">
					<h2>Tags : <?php echo single_cat_title();?></h2><span class="bg_right"></span>
				</div>
				<div class="archive-meta"><p><?php echo category_description(); ?></p></div>
				<div class="row_content">
					<div class="list_article list_horizontal">
						<ul class="list_article_ul">
						<?php					
							while (have_posts()) {
								the_post();
						?>
							<li class="item"><?php get_template_part( 'content', get_post_format() ); ?></li>
						<?php
							}
						?>
						</ul>
						<div class="page_navi"><?php wp_pagenavi(); ?></div>
					</div>
				</div>
			</div><!--End row-->
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