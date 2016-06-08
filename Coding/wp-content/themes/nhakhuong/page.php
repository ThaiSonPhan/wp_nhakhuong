<?php get_header();?>

<div id="primary" class="">
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
					<div class="entry-info">
						<span class="text">Cập nhật do</span>
						<span class="author"><?php the_author();?></span>
						<span class="text">vào lúc</span>
						<span class="date"><?php the_date();?></span>
					</div>				
					<div class="description">
						<?php //the_excerpt(); ?>
					</div>
					<div class="content">
						<?php the_content(); ?>
					</div>
				</div>
			</article>
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