<?php header( "refresh:10;url=".PATH_URL."");?>
<?php get_header();?>
<style type="text/css" media="screen">
	.error_404 {
		display: block;
		margin: 0;
		padding: 0;
		min-height: 500px;
		text-align: center;
	}
</style>
<div class="error_404">
	<h1>Liên kết này hiện không có !</h1>
	<h2>Error Page 404</h2>	
	<a class="homepage" href="<?php PATH_URL ?>" title="<?php PATH_URL ?>">Trang chủ</a>
</div>
<?php get_footer();?>