<?php
// Constant
define('PATH_URL', get_bloginfo('url'));
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('NOW', current_time('mysql'));


if ( ! function_exists( 'theme_init' ) ) :
function theme_init() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'nhakhuong', get_template_directory() . '/languages' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'header-menu'   		=> __( 'Header menu', 'nhakhuong' ),
		'header-menu-mobile' 	=> __( 'Header menu for mobile', 'nhakhuong' ),
		'footer-menu' 			=> __( 'Footer menu', 'nhakhuong' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // theme_init
add_action( 'after_setup_theme', 'theme_init' );


/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since 1.0
 */
function theme_widgets_init() {
	// require get_template_directory() . '/inc/widgets.php';
	// register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );


// Add Options page
if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Page Options',
		'menu_title' => 'Page Options',
		'menu_slug' => 'page-options',
		'capability' => 'edit_posts',
		'parent_slug' => '',
		'position' => 4,
		'icon_url' => false
	));
}
/**
 * Create a nav menu with very basic markup.
 *
 * @author Thomas Scholz http://toscho.de
 * @version 1.0
 */
class Nav_Menu_Walker_Header extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth, $args = array(), $id = 0 )
	{
		global $currentPage;
		
		$classes = '';
		if($item->classes) {
			$classes = implode(' ', $item->classes);
		}
		! empty ($item->current)
			and $classes .= ' active';
		$output     .= '<li id="menu-item-' . $item->ID . '" class="first_li ' . $classes . '">';
		$attributes  = '';

		! empty ( $item->attr_title )
			// Avoid redundant titles
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

		! empty ( $item->url )
			and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
		! empty ($item->current)
			and $attributes .= ' class="active"';
		!empty($currentPage)
			and ($currentPage == $item->ID)
			and $attributes .= ' class="active"';
		$attributes  = trim( $attributes );
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$item_output = "$args->before<a rel='dofollow' $attributes>$args->link_before$title</a>"
						. "$args->link_after$args->after";
		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
			,	$id
		);
	}

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function start_lvl( &$output )
	{
		$output .= '<ul class="sub-menu">';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function end_lvl( &$output )
	{
		$output .= '</ul>';
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	function end_el( &$output )
	{
		$output .= '</li>';
	}
}
class Nav_Menu_Walker_Footer extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth, $args )
	{
		$attributes  = '';
		$output     .= '<li id="menu-item-' . $item->ID . '">';
		! empty ( $item->attr_title )
			// Avoid redundant titles
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

		! empty ( $item->url )
			and $attributes .= ' href="' . esc_attr( $item->url ) .'"';

		$attributes  = trim( $attributes );
		$rel = '';
		$item->attr_target ? $target = '_blank' : $target = '';
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$item_output = "$args->before<a rel='$rel' $attributes target='$target'>$args->link_before$title</a>"
						. "$args->link_after$args->after";
		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
		);
	}

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function start_lvl( &$output )
	{
		$output .= '<ul class="sub-menu">';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function end_lvl( &$output )
	{
		$output .= '</ul>';
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	function end_el( &$output )
	{
		$output .= '</li>';
	}
}

function alert_menu() {
	echo '<div>Go to Admin > Appearance > Menus to set up the menu. You need to run WP 3.0+ for custom menus to work.</div>';
}
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

if(!function_exists('pr')) {
	function pr($data, $exit = false) {
		ob_start();
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		$content = ob_get_clean();
		echo $content;
		if($exit)
			exit;
	}
}

/* Add post type for tag category */
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  	if ( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
	    $post_type = get_query_var('post_type');
	    if($post_type)
	        $post_type = $post_type;
	    else
	        $post_type = array('post','tin-tuc','san-pham'); // replace cpt to your custom post type
	    $query->set('post_type',$post_type);
	    return $query;
    }
}

// Display user ip
function getIP() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function getAgent() {
	return $_SERVER['HTTP_USER_AGENT'];
}



add_action('admin_init', 'no_mo_dashboard');
function no_mo_dashboard() {	
  if ((!current_user_can('publish_posts') || !current_user_can('moderate_comments')) && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
  	//wp_redirect(home_url()); exit;
  }
}

show_admin_bar(false); // Disable admin bar
//Remove theme and plugin editor links
function hide_menu()
{
	 // global $submenu;	
     // Appearance Menu
     //remove_menu_page( 'plugins.php' ); //Plugins     
     // unset($submenu['themes.php'][5]); // Themes
     // unset($submenu['themes.php'][6]); // Customize
}
add_action('admin_menu','hide_menu');
if(function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');  // Enable post thumbnail
	add_theme_support('menus'); // Enale menu in dashboard
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function the_slug($echo = true) {
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if( $echo ) echo $slug;
	do_action('after_slug', $slug);
	return $slug;
}

add_filter('query_vars', 'my_query_vars');
function my_query_vars($vars){
  $vars[] = 'code';
  $vars[] = 'state';
  $vars[] = 'error';
  $vars[] = 'error_reason';
  $vars[] = 'error_code';
  $vars[] = 'error_description';
  $vars[] = 'user_denied';
  $vars[] = 'permissions';

  // Var for search
  $vars[] = 'type';
  $vars[] = 'data';
  $vars[] = 'resource';
    return $vars;
}

function getRewriteSlug($postType) {
	$rewriteSlug = array( 'product' => 'product'									
					);
	if(isset($rewriteSlug[$postType])) {
		return $rewriteSlug[$postType];
	}
	return $postType;
}
/**
 * Remove the slug from published post permalinks.
 */
// function custom_remove_cpt_slug( $post_link, $post, $leavename ) { 	
//     if ( 'publish' != $post->post_status ) {
//         return $post_link;
//     }    
//     //echo $post_link;
//     $post_link = str_replace( '/' . getRewriteSlug($post->post_type) . '/', '/', $post_link );
 
//     return $post_link;
// }
// add_filter( 'post_type_link', 'custom_remove_cpt_slug', 10, 3 );
/**
 * Some hackery to have WordPress match postname to any of our public post types
 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
 * Typically core only accounts for posts and pages where the slug is /post-name/
 */
// function custom_parse_request_tricksy($query) {
//     // Only noop the main query
//     if ( ! $query->is_main_query() )
//         return;

//     // Only noop our very specific rewrite rule match
//     if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
//         return;
//     }
//     // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
//     if ( ! empty( $query->query['name'] ) ) {
//         $query->set( 'post_type', array( 'post', 'slider', 'tour', 'attractions') );
//     }
// }
// add_action( 'pre_get_posts', 'custom_parse_request_tricksy' );

// Template function
function getTermsByTaxonomy($taxonomies, $params = null, $all = false) {
	if(!$taxonomies)
		return false;
	if(!is_array($taxonomies)) {
		$taxonomies = array(
				$taxonomies
			);
	}
	$argsDefault = array(
	    'orderby'           => 'name', 
	    'order'             => 'ASC',
	    'hide_empty'        => !$all, 
	    'exclude'           => array(), 
	    'exclude_tree'      => array(), 
	    'include'           => array(),
	    'number'            => '', 
	    'fields'            => 'all', 
	    'slug'              => '',
	    'parent'            => '',
	    'hierarchical'      => true, 
	    'child_of'          => 0, 
	    'get'               => '', 
	    'name__like'        => '',
	    'description__like' => '',
	    'pad_counts'        => false, 
	    'offset'            => '', 
	    'search'            => '', 
	    'cache_domain'      => 'core'
	); 
	($params != null && is_array($params) && $argsDefault = array_merge($argsDefault, $params));	
	$terms = get_terms($taxonomies, $argsDefault);
	return $terms;
}


/*
* getFieldByTerm
* params:
* 		- field
* 		- taxonomy
* 		- term_id
* return: field value
*/
function getFieldByTerm($field, $taxonomy, $termID, $echo = false) {
	if(!$echo)
		return get_field($field, $taxonomy . '_' . $termID); 
	echo get_field($field, $taxonomy . '_' . $termID);
}

/*
* getFieldByTermObj
* params:
* 		- field
* 		- term Object
* return: field value
*/
function getFieldByTermObj($field, $termObj, $echo = false) {
	if(!$echo)
		return get_field($field, "{$termObj->taxonomy}_{$termObj->term_id}");
	echo get_field($field, "{$termObj->taxonomy}_{$termObj->term_id}");
}

/*
* getPostByTerm
* params:
* 		- post-type
* 		- taxonomy
* 		- term_id
*		- params: array()
* return: all posts by term
*/
function getPostByTerm($postType, $taxonomy, $termID, $params = null) {
	$defaultParams = array(
					    'post_type' => $postType,
					    'posts_per_page' => -1,
					    'tax_query' => array(					       
					        array(
					        	'taxonomy' => $taxonomy,
						        'field' => 'term_id',
						        'terms' => $termID
						        )
					        )
   					);
	($params != null && is_array($params))  &&  $defaultParams = array_merge($defaultParams, $params);	
	return get_posts($defaultParams);
}

/*
* getPostByTermObj
* params:
* 		- post-type
* 		- term: term object
*		- params: array()
* return: all posts by term
*/
function getPostByTermObj($postType, $term, $params = null) {
	return getPostByTerm($postType, $term->taxonomy, $term->term_id, $params);
}

/**
 * getPosts
 * @param  string $postType : post type
 * @param  array $params   	: aguments to get post
 * @return array            : posts terms and conditions
 */
function getPosts($postType = null, $params = null, $wp_query = false) {
	$postType || $postType = 'post';	
	$defaultParams = array(
		'post_type' => $postType,		
		'posts_per_page' => -1,
		'suppress_filters' => false
	);
	($params != null && is_array($params))  &&  $defaultParams = array_merge($defaultParams, $params);	
	//pr($defaultParams);
	return !$wp_query ? get_posts($defaultParams) : new WP_Query($defaultParams);
}


/**
 * getPostsByQuery
 * @param  array $queryParams : param to get post, example
 * @param  constant $type     : type post get (OBJECT, ARRAY_A, ARRAY_N)
 * @return array              : posts terms and condition by params
 */
function getPostsByQuery($queryParams = null, $type = OBJECT) {
	
	if(!$queryParams)
		return null;
	$orderBy = $queryParams['orderby'] ?: 'post_date';	
	$order = $queryParams['order'] ?: 'DESC';
	$limit = $queryParams['limit'] ?: '';
	$offset = $queryParams['offset'] ?: '0';
	$whereStr = 'WHERE ';
	if($queryParams['meta_query']) {		
		$queryParams['meta_query']['relation'] = $queryParams['meta_query']['relation'] ?: 'AND';		
		$whereStr .= buildQuery($queryParams['meta_query']);
	} else 
		$whereStr .= '1 ';
	// Begin query
	global $wpdb;
	global $post;
	
	$orderStr = "ORDER BY post.$orderBy $order ";
	$queryStr = "
	SELECT DISTINCT post.* 
	FROM $wpdb->posts post
		LEFT JOIN $wpdb->postmeta meta ON post.ID = meta.post_id 
		LEFT JOIN $wpdb->term_relationships ON (post.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = taxonomy.term_taxonomy_id) 
	";
	$queryStr .= $whereStr . $orderStr;
	if($limit)
		$queryStr .= "LIMIT $offset, $limit ";		
	$data = $wpdb->get_results($queryStr, $type);
	return $data;
}

function buildQuery($arrQuery) {
	global $wpdb;
	$dataRender = '';
	if(!isset($arrQuery['relation']) || count($arrQuery) < 3) { // stoping condition
		$type = $arrQuery['type'];
		$compare = $arrQuery['compare'] ?: '=';
		$dataType = $arrQuery['data_type'] ?: 'string';
		$value = in_array($compare, array('LIKE', 'NOT LIKE')) ? '%' . $wpdb->esc_like($arrQuery['value']) . '%' : $arrQuery['value'];
		
		switch ($type) {
			case 'taxonomy':
			case 'term':
			case 'post':
				$dataRender .= (is_array($value) ? $type . '.' . $arrQuery['key'] . ' ' . $compare . ' (' . implode(',', estimateValue($value, $dataType)) . ') '
		 										: "$type.{$arrQuery['key']} $compare " . estimateValue($value, $dataType) . " ");
				break;
			case 'meta':
				$dataRender .= (is_array($value) ? 'AND meta.meta_value ' . $compare . ' (' . implode(',', estimateValue($value, $dataType)) . ') '
		 										: "AND meta.meta_value $compare " . estimateValue($value, $dataType) . " ");
				$dataRender = "(meta.meta_key = '{$arrQuery['key']}' " . $dataRender . ') ';
				break;
			default:				
				break;
		}
		 return $dataRender;
	}	
	$arrQuery['relation']  = $arrQuery['relation'] ?: 'AND';
	$relation = $arrQuery['relation'];	
	unset($arrQuery['relation']);	
	$arrBuild = array();
	foreach ($arrQuery as $query) {
		$arrBuild[] = buildQuery($query);
	}
	return '(' . implode(' ' . $relation . ' ', $arrBuild) . ') ';
}

function estimateValue($value, $type = 'string') {
	switch ($type) {
		case 'string':
			return '\'' . $value . '\'';
			break;
		case 'int':
			return intval($value);
			break;
		default:
			return $value;
			break;
	}
}


/*
* getTermsByPost (Related post or post tag)
* params:
* 		- post id
* 		- taxonomy: (taxonomy slug | category | post_tag)
* return: all terms related by post
*/
function getTermsByPost($postID, $taxonomy) {
	return get_the_terms($postID, $taxonomy);
}

/*
* checkActive
* params:
* 		- p1: id 1
*		- p2: id 2
* 		- classActive: class active
*		- classInActive: class inactive
* return: echo active or inactivec class
*/

function checkActive($p1, $p2, $classActive = 'active', $classInActive = '') {
	echo ($p1 == $p2 ?  $classActive : $classInActive);
}

/*
* getData
* params:
*		- $row
*		- $default: default data
* return: $row data if $row not empty otherwise $default
*/
function getData($row, $default = '') {

	($row || $row = $default);
	return $row;
}

function robins_get_the_excerpt($post_id) {
  global $post;  
  $save_post = $post;
  $post = get_post($post_id);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}


/**
 * getTemplatePart
 * @param  [type]  $slug   [description]
 * @param  [type]  $name   [description]
 * @param  array   $params [description]
 * @param  boolean $return [description]
 * @return [type]          [description]
 */
function getTemplatePart($slug = null, $name = null, array $params = array(), $return = false) {
    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

    do_action("get_template_part_{$slug}", $slug, $name);
    $templates = array();
    if (isset($name))
        $templates[] = "{$slug}-{$name}.php";

    $templates[] = "{$slug}.php";

    $_template_file = locate_template($templates, false, false);

    if (is_array($wp_query->query_vars)) {
        extract($wp_query->query_vars, EXTR_SKIP);
    }
    extract($params, EXTR_SKIP);   
    if($return)
    	ob_start();
    require($_template_file);
    if($return) {
    	$content = ob_get_clean();
    	return $content;
    }
}

function getImageDevice() {
	return DEVICE_TYPE == 'mobile' ? 'thumbnail' : 'full';
}

function get_the_post_thumbnail_src($img) {
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

/**
 * genMetaFacebook generate meta tag for facebook share
 * @return html meta tag
 */
function genMetaSocial() {
	$domain = $_SERVER['SERVER_NAME'];
	$site_name = get_bloginfo( 'name' );
	$lang = get_locale();
	if( is_single() && have_posts() ) {
		while (have_posts()) {
			the_post();
			$title = get_the_title();
			$url = get_the_permalink();
			$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			if (empty($image)) {
				$image = get_bloginfo('template_url' ) . '/images/share_social.jpg';
			}
			$description = get_the_excerpt();
		}
		
// <meta property="article:author" content="https://www.facebook.com/Hynos-Travel-786705761452279/" />
		$renderFacebookMeta = <<<FACEBOOKMETA
<!-- Meta social post -->
<meta property="article:author" content="https://www.facebook.com/Máy-Bún-Phở-Chấm-Net-1434066833542859/" />
<meta property="og:site_name" content="$site_name" />
<meta property="og:locale" content="$lang" />
<meta property="og:type" content="article" />
<meta property="og:title" content="$title" />
<meta property="og:description" content='$description' />
<meta property="og:url" content="$url" />
<meta property="og:image" content="$image" />
<meta itemprop="name" content="$title">
<meta itemprop="description" content="$description">
<meta itemprop="image" content="$image">
<meta name="twitter:domain" content="$domain"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="$description"/>
<meta name="twitter:title" content="$title"/>
<meta name="twitter:image:src" content="$image"/>
FACEBOOKMETA;
	echo $renderFacebookMeta;
	} else {		
		$image = get_bloginfo('template_url' ) . '/images/share_social.jpg';
		$description = get_bloginfo('description');
		$renderFacebookMeta = <<<FACEBOOKMETA
<!-- Meta social -->
<meta property="article:author" content="https://www.facebook.com/Máy-Bún-Phở-Chấm-Net-1434066833542859/" />
<meta property="og:site_name" content="$site_name" />
<meta property="og:locale" content="$lang" />
<meta property="og:type" content="article" />
<meta property="og:title" content="$site_name" />
<meta property="og:description" content="$description" />
<meta property="og:image" content="$image" />
<meta itemprop="name" content="$site_name">
<meta itemprop="description" content="$description">
<meta itemprop="image" content="$image">
<meta name="twitter:domain" content="$domain"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="$description"/>
<meta name="twitter:title" content="$title"/>
<meta name="twitter:image:src" content="$image"/>
FACEBOOKMETA;
		echo $renderFacebookMeta;
	}
}

function isPost($id) {
	if ( FALSE === get_post_status( $id ) ) {
	  return false;
	} else {
	  return true;
	}
}


/**
 * [sendMailSTMP send mail via SMTP]
 * @return [status send mail] 
 */
function sendMailSMTP($subject, $msg) {	
	// include_once(LIBPATH . 'phpmailer/PHPMailerAutoload.php');
	// $mail = new PhpMailer(); 
	// $mail->SMTPAuth   = true;                  // enable SMTP authentication
	// $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	// $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	// $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	// $mail->Username   = "luuxuantruong0101@gmail.com";  // GMAIL username
	// $mail->Password   = "truong144871188";
	// $mail->isSMTP();
	// $mail->SMTPDebug = 0;
	// $mail->Debugoutput = 'html';
	// $mail->CharSet  = 'UTF-8';
	// $mail->setFrom('xuantruong1234@gmail.com', 'MONMONMONGAY');
	// $mail->AddReplyTo('xuantruong1234@gmail.com', 'MONMONMONGAY');
	// $mail->addAddress('xuantruong1234@gmail.com', 'MONMONMONGAY');
	// $mail->Subject = $subject;
	// $mail->Body    = $subject;	
	// $mail->msgHTML($msg);
	// //Replace the plain text body with one created manually
	// $mail->AltBody = 'This is a plain-text message body';
	// return $mail->send();
}

//dem luot views cua bai post
// function setpostview($postID){
//     $count_key ='post_views_count';
//     $count = get_post_meta($postID, $count_key,true);
//     if($count==''){
//         $count =0;
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key,'0');
//     }else{
//         $count++;
//         update_post_meta($postID, $count_key, $count);
//     }
// }
//hien luot views cua bai post
// function getpostviews($postID){
//     $count_key ='post_views_count';
//     $count = get_post_meta($postID, $count_key,true);
//     if($count==''){
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key,'0');
//         return"0 View";
//     }
//     return $count;
// }

// Update views
// function updateViews($postID) {
// 	$cView = get_field('views', $postID);
// 	update_post_meta($postID, 'views', $cView + 1 );
// }

// Cắt văn bản theo ký tự
function CutShortText($text, $limit, $ellipsis) {
  $chars_limit = $limit;
  $chars_text = strlen($text);
  $text = $text." ";
  $text = substr($text,0,$chars_limit);
  $text = substr($text,0,strrpos($text,' '));


  if ($chars_text > $chars_limit)
    { $text = $text.$ellipsis; }
    return $text;
}
// Lấy thứ ngày trong tuần
// function DayOfWeeks($day_month_year, $get_day_name = null) {	
// 	$day_month_year_arr = explode('/', $day_month_year);
// 	$day= $day_month_year_arr[0];
// 	$month= $day_month_year_arr[1];
// 	$year= $day_month_year_arr[2];
// 	$jd=cal_to_jd(CAL_GREGORIAN,$month,$day,$year);
// 	$jdDayOfWeeks=jddayofweek($jd,0);
// 	$DayOfWeeks = "";
// 	//Nếu $get_day_name có thì chạy ra thứ ngày tiếng việt
// 	if ($get_day_name == 'vi') {
// 		switch ($jdDayOfWeeks) {
// 		    case 0:
// 		        $DayOfWeeks = "Chủ nhật";
// 		        break;
// 		    case 1:
// 		        $DayOfWeeks = "Thứ Hai";
// 		        break;
// 		    case 2:
// 		        $DayOfWeeks = "Thứ Ba";
// 		        break;
// 		    case 3:
// 		        $DayOfWeeks = "Thứ Tư";
// 		        break;
// 		    case 4:
// 		        $DayOfWeeks = "Thứ Năm";
// 		        break;
// 		    case 5:
// 		        $DayOfWeeks = "Thứ Sáu";
// 		        break;
// 		    case 6:
// 		        $DayOfWeeks = "Thứ Bảy";
// 		        break;
// 		}
// 	} elseif ($get_day_name == 'en') {
// 		switch ($jdDayOfWeeks) {
// 		    case 0:
// 		        $DayOfWeeks = "Sunday";
// 		        break;
// 		    case 1:
// 		        $DayOfWeeks = "Monday";
// 		        break;
// 		    case 2:
// 		        $DayOfWeeks = "Tuesday";
// 		        break;
// 		    case 3:
// 		        $DayOfWeeks = "Wednesday";
// 		        break;
// 		    case 4:
// 		        $DayOfWeeks = "Thursday";
// 		        break;
// 		    case 5:
// 		        $DayOfWeeks = "Friday";
// 		        break;
// 		    case 6:
// 		        $DayOfWeeks = "sarturday";
// 		        break;
// 		}
// 	} else {
// 		$DayOfWeeks = $jdDayOfWeeks;
// 	}
// 	return $DayOfWeeks;
// }