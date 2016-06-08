<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<header class="page-header">
	<h1 class="page-title OptimaRegular"><?php _e( 'Không tìm thấy kết quả', 'madebyson' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Sẵn sàng để đăng bài viết đầu tiên của bạn? <a href="%1$s">Hãy bắt đầu tại đây</a>.', 'madebyson' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Xin lỗi, nhưng không có gì phù hợp với điều kiện tìm kiếm của bạn. Vui lòng thử lại với từ khoá khác nhau.', 'madebyson' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( 'Có vẻ như chúng ta không thể tìm thấy những gì bạn tìm kiếm. Hãy thử tìm kiếm với công cụ dưới đây.', 'madebyson' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
