<?php
if ( post_password_required() )
	return;
?>
<?php
function raynoblog_comment_text($args) {
    $args['title_reply']='Bình luận';
    return $args;
}
add_filter( 'comment_form_defaults', 'raynoblog_comment_text' );

function raynoblog_change_submit_comment( $defaults ) {
    $defaults['label_submit'] = 'Gửi bình luận';
    return $defaults;
}
add_filter( 'comment_form_defaults', 'raynoblog_change_submit_comment' );

// function add_comment_fields($fields) {
//     $fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Country' ) . '</label>' .
//         '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
//     return $fields;
// }
// add_filter('comment_form_default_fields','add_comment_fields');
// Bỏ field URL bằng unset field
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'indochina' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'website' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'quangphuoc' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'quangphuoc' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'quangphuoc' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
<style type="text/css" media="screen">

/**
 * 5.12 Comments
 * ----------------------------------------------------------------------------
 */
ol.comment-list {
	overflow: hidden;
}
.comments-title,
.comment-list,
.comment-reply-title,
.must-log-in,
.comment-respond .comment-form,
.comment-respond iframe {
	display: block;
	margin-left: auto;
	margin-right: auto;
	max-width: 90%;
	width: 100%;
}

.sidebar .comments-title,
.sidebar .comment-list,
.sidebar .must-log-in,
.sidebar .comment-reply-title,
.sidebar .comment-navigation,
.sidebar .comment-respond .comment-form {
	max-width: 90%;
	padding-left: 60px;
	padding-right: 376px;
}

.comments-title {
	font: 300 italic 28px "Source Sans Pro", Helvetica, sans-serif;
}

.comment-list,
.comment-list .children {
	list-style-type: none;
	padding: 0;
}

.comment-list .children {
	margin-left: 8%;
}

.comment-list li {
	width: 94%;
	padding: 0 3%;
}
.comment-list li:hover {
	background-color: #dadada;
}
.comment-list > li:after,
.comment-list .children > li:before {
	border-top: 1px dotted #B7B7B7;
	content: "";
	display: block;
	height: 1px;
	width: 100%;
	clear: both;
}

.comment-list > li:last-child:after {
	display: none;
}
.comment-body {
	min-height: 90px;
	padding: 20px 0;
	position: relative;
}

.comment-author {
	float: left;
	max-width: 74px;
	margin-right: 20px;
}

.comment-author .avatar {
	display: block;
	margin-bottom: 10px;
}

.comment-author .fn {
	word-wrap: break-word;
}

.comment-author .fn,
.comment-author .url,
.comment-reply-link,
.comment-reply-login {
	color: #cd3333;
	font-size: 14px;
	font-style: normal;
	font-weight: normal;
}

.says {
	display: none;
}

.no-avatars .comment-author {
	margin: 0 0 5px;
	max-width: 100%;
	position: relative;
}

.no-avatars .comment-metadata,
.no-avatars .comment-content,
.no-avatars .comment-list .reply {
	width: 100%;
}

.bypostauthor > .comment-body .fn:before {
	/*content: "\f408";*/
	vertical-align: text-top;
}

.comment-list .edit-link {
	margin-left: 20px;
}

.comment-metadata,
.comment-awaiting-moderation,
.comment-content,
.comment-list .reply {
	float: right;
	width: 79%;
	width: -webkit-calc(100% - 124px);
	width:         calc(100% - 124px);
	word-wrap: break-word;
}
.comment-list .reply{
	text-align: right;
}
.comment-meta,
.comment-meta a {
	color: #a2a2a2;
	font-size: 13px;
}

.comment-meta a:hover {
	color: #ea9629;
}

.comment-metadata {
	margin-bottom: 20px;
}

.ping-meta {
	color: #a2a2a2;
	font-size: 13px;
	line-height: 2;
}

.comment-awaiting-moderation {
	color: #a2a2a2;
}

.comment-awaiting-moderation:before {
	/*content: "\f414";*/
	margin-right: 5px;
	position: relative;
	top: -2px;
}

.comment-reply-link:before,
.comment-reply-login:before {
	/*content: "\f412";*/
	margin-right: 3px;
}

/* Comment form */
.comment-respond {
	background-color: #DADADA;
	padding: 30px 0;
}

.comment .comment-respond {
	margin-bottom: 20px;
	padding: 20px;
}

.comment-reply-title {
	font: 300 italic 28px "Source Sans Pro", Helvetica, sans-serif;
}

.comment-reply-title small a {
	color: #131310;
	display: inline-block;
	float: right;
	overflow: hidden;
	width: 100px;
	font-size: 14px;
}

.comment-reply-title small a:hover {
	color: #ed331c;
	text-decoration: none;
}

.comment-reply-title small a:before {
	/*content: "\f406";*/
	vertical-align: top;
}
.sidebar .comment-list .comment-reply-title,
.sidebar .comment-list .comment-respond .comment-form {
	padding: 0;
}

.comment-form .comment-notes {
	margin-bottom: 15px;
}

.comment-form .comment-form-author,
.comment-form .comment-form-email,
.comment-form .comment-form-url {
	margin-bottom: 8px;
}

.comment-form [for="author"],
.comment-form [for="email"],
.comment-form [for="url"],
.comment-form [for="comment"] {
	float: left;
	padding: 5px 0;
	width: 120px;
}

.comment-form .required {
	color: #ed331c;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"] {
	max-width: 270px;
	width: 60%;
	padding: 5px 0;
}

.comment-form textarea {
	width: 100%;
}

h2.comments-title {
	font-size: 18px;
}

.form-allowed-tags,
.form-allowed-tags code {
	color: #DADADA;
	font-size: 12px;
}

.form-allowed-tags code {
	font-size: 10px;
	margin-left: 3px;
}

.comment-list .pingback,
.comment-list .trackback {
	padding-top: 24px;
}

.comment-navigation {
	font-size: 20px;
	font-style: italic;
	font-weight: 300;
	margin: 0 auto;
	max-width: 604px;
	padding: 20px 0 30px;
	width: 100%;
}

.no-comments {
	background-color: #DADADA;
	font-size: 20px;
	font-style: italic;
	font-weight: 300;
	margin: 0;
	padding: 40px 0;
	text-align: center;
}

.sidebar .no-comments {
	padding-left: 60px;
	padding-right: 376px;
}
#submit {
    background: #CD3333 !important;
    border: 1px solid #B70000;
    color: #fff;
    cursor: pointer;
    font-family: 'Oswald', arial, serif !important;
    font-size: 17px !important;
    font-weight: bold !important;
    padding: 10px 15px;
    text-decoration: none;
    text-transform: uppercase;
    -moz-border-radius: 2px; 
    -webkit-border-radius: 2px; 
    border-radius: 2px;
}
#submit:hover {
    background: #B70000 !important;
    border: 1px solid #CD3333;
    color: #fff;
    text-decoration: none;
    text-transform: uppercase;
}
</style>