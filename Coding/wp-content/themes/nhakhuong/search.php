<?php get_header(); ?>

<div id="primary" class="">
	<div class="wrap_primary">
		<div class="content list padding_none">
<?php 
	if(have_posts()){
?>
			<div class="row">
				<div class="row_top">
					<h3>Kết quả tìm kiếm</h3><span class="bg_right"></span>
				</div>
				<div class="archive-meta"><p>Key search <?php echo $count_search; ?>"<b><?php echo get_search_query(); ?></b>"</p></div>
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