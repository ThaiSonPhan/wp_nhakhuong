<?php	
	$currentObject = get_queried_object();
	// pr($currentObject,1);
	$taxonomy = '';

	$slugObject = '';
	if (!empty($currentObject)) {
		$taxonomy = $currentObject->taxonomy;
		$slugObject = $currentObject->slug;
	}

	//lấy slug của term khi ở post page
	if (is_page()) {
		global $term_slug;
		if (!empty($term_slug)) {
			$slugObject = $term_slug;
		}
		if ($currentObject->post_name == 'tin-tuc') {
			$taxonomy = 'danh-muc-tin-tuc';
		}
		if ($currentObject->post_name == 'san-pham') {
			$taxonomy = 'danh-muc-san-pham';
		}
	}
	// pr($slugObject,1);
	$post_id= get_the_id();
	global $item_small;
?>
<div class="image">
	<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
		<?php the_post_thumbnail( 'medium', array('class' => 'img', 'alt' => get_the_title() ));?>
	</a>
</div>
<div class="title">
	<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
</div>

<!-- Chỉ hiện khi không phải thuộc trang chu hoac giới thiệu -->
<?php if ( $slugObject != 'gioi-thieu' ) { ?>
<div class="entry-info">
	<span class="text">Cập nhật bởi</span>
	<span class="author"><?php the_author();?></span>
	<span class="text">vào</span>
	<span class="date"><?php echo get_the_time('d/m/Y', get_the_id());?></span>
<?php 
if ( !is_home() ){ 
	if ( !is_single() ) { 
?>
	<span class="text text3">trong</span>
	<span class="category"><?php echo get_the_term_list( get_the_id(), $taxonomy, '', ', ' ); ?></span>
<?php 
	}
} 
?>
</div>
<?php } ?>

<?php 
if ( !is_single() ) { 
	if ( $item_small == '' ) { 
?>
<div class="description">
	<span><?php the_excerpt() ?></span>
</div>
<div class="button">
	<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">Chi tiết »</a>
</div>
<?php
	} 
} 
?>