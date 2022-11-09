<?php

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('embed_head', 'print_emoji_detection_script');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('emoji_svg_url', '__return_false' );

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wc_page_noindex');
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

function remove_needless_css() {
	wp_dequeue_style('global-styles');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('classic-theme-styles');
	
}
add_action('wp_enqueue_scripts', 'remove_needless_css', 100);

function biopu_styles_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('highlight', get_template_directory_uri() . '/assets/css/default.min.css');
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js');
	wp_enqueue_script('highlight', get_template_directory_uri(). '/assets/js/highlight.min.js');
	wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/scripts.js');
}
add_action('wp_enqueue_scripts', 'biopu_styles_scripts');

//from https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
class Bootstrap_Nav_Walker extends Walker_Nav_menu
{
	private $current_item;
	private $dropdown_menu_alignment_values = [
		'dropdown-menu-start',
		'dropdown-menu-end',
		'dropdown-menu-sm-start',
		'dropdown-menu-sm-end',
		'dropdown-menu-md-start',
		'dropdown-menu-md-end',
		'dropdown-menu-lg-start',
		'dropdown-menu-lg-end',
		'dropdown-menu-xl-start',
		'dropdown-menu-xl-end',
		'dropdown-menu-xxl-start',
		'dropdown-menu-xxl-end'
	];

	function start_lvl(&$output, $depth = 0, $args = null)
	{
		$dropdown_menu_class[] = '';
		foreach($this->current_item->classes as $class) {
			if(in_array($class, $this->dropdown_menu_alignment_values)) {
				$dropdown_menu_class[] = $class;
			}
		}
		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$this->current_item = $item;

		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = 'nav-item';
		$classes[] = 'px-2 py-1';
		$classes[] = 'nav-item-' . $item->ID;
		if ($depth && $args->walker->has_children) {
			$classes[] = 'dropdown-menu dropdown-menu-end';
		}

		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		$active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
		$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
		$attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');

function biopu_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length', 'biopu_excerpt_length');

function biopu_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'biopu_excerpt_more');

//add view count
function view_counter() {
	if (is_singular()) {
		global $post;
		if ($post->ID) {
			$post_views = (int)get_post_meta($post->ID, 'views', true);
			if (!update_post_meta($post->ID, 'views', $post_views+1)) {
				add_post_meta($post->ID, 'views', 1, true);
			}
		}
	}
}
add_action('wp_head', 'view_counter');
function the_views() {
	global $post;
	$views = (int)get_post_meta($post->ID, 'views', true);
	if ($views > 1) {
		echo $views, " Reads";
	} else {
		echo $views, " Read";
	}
}

function biopu_category_class($thelist) {
	$categories = get_the_category();

	if (!$categories || is_wp_error($categories)) {
		return $thelist;
	}

	$output = '<ul class="list-inline d-inline-block">';
	foreach ( $categories as $category ) {
		$output .= '<li class="list-inline-item"><a class="badge rounded-pill text-bg-success text-decoration-none" href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></li>';
	}
	$output .= '</ul>';
	return $output;
}
add_filter('the_category', 'biopu_category_class');

//sidebar
function biopu_register_sidebars() {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'main-sidebar',
		'description' => 'main sidebar',
		'class' => '',
		'before_widget' => '<div class="widget-body mb-5">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Post Header AD',
		'id' => 'post-header-ad',
		'description' => 'ad in header of single page',
		'class' => '',
		'before_widget' => '<div class="text-center">',
		'after_widget' => '</div>',
	));
	register_sidebar(array(
		'name' => 'Post Footer AD',
		'id' => 'post-footer-ad',
		'description' => 'ad in footer of single page',
		'class' => '',
		'before_widget' => '<div class="text-center">',
		'after_widget' => '</div>',
	));
}
add_action('widgets_init', 'biopu_register_sidebars');
?>


<?php
//comments
function biopu_comment_list($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	$colors = array('text-bg-light', 'text-bg-dark', 'text-bg-success',
		'text-bg-primary', 'text-bg-danger', 'text-bg-secondary'
	);
	$at = '';
	if ($depth > 0 && $comment->comment_parent) {
		$at = get_comment_author($comment->comment_parent);
		if ($at) {
			$at = '<a class="badge ' .$colors[$depth]. '" href="#comment-'.$comment->comment_parent. '">@ '.$at.'</a>';
		} else {
			$at = '';
		}
	}
?>
	<li id="comment-<?php comment_ID() ?>">
		<div class="d-flex">
			<div class="flex-shrink-0">
				<div class="comment-avatar">
					<img src="https://dn-qiniu-avatar.qbox.me/avatar/" class="rounded rounded-circle" width="36" height="36">
				</div>
			</div>
			<div class="flex-grow-1 ms-3">
				<div class="comment-meta">
					<ul class="list-inline">
						<li class="list-inline-item"><?php echo get_comment_author_link(); ?></li>
						<?php if ($at) : ?>
						<li class="list-inline-item"><?php echo $at; ?></li>
						<?php endif; ?>
						<li class="list-inline-item"><?php echo get_comment_date('M j, Y'); ?></li>
						<li class="list-inline-item comment-action">
							<span><?php echo edit_comment_link('', '  ', ''); ?></span>
							<span class="ms-3"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => ''))); ?></span>
						</li>
					</ul>
				</div>
				<div class="comment-content mt-3">
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
	</li>
<?php } ?>
