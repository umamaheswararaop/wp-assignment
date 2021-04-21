<?php
//$content_width is required even though this is a variable-width theme
if (!isset($content_width))
	$content_width = 400;

//makes replying look neat
if (!function_exists('chromapark_threaded_comments')):
function chromapark_threaded_comments() {
	if (get_option('thread_comments'))
		wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'chromapark_threaded_comments');
endif;

// displays "Comments are closed" instead of comment form when comments are closed.
if (!function_exists('chromapark_closed_comments')):
function chromapark_closed_comments() {
	echo '<p>', esc_html__('Comments are closed.', 'chroma-park'), '</p>';
}
add_action('comment_form_comments_closed', 'chromapark_closed_comments');
endif;

if (!function_exists('chromapark_setup')):
function chromapark_setup() { //adds theme support
	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support('starter-content', array(
	'widgets' => array(
		'left-sidebar' => array(
			array(
				'text',
				array(
					'title' => __('First Sidebar', 'chroma-park'),
					'text' => _x('This is some text in the first sidebar.', 'Theme Starter Content', 'chroma-park')
				)
			),
			'meta'
		),
		'right-sidebar' => array(
			array(
				'text',
				array(
					'title' => __('Second Sidebar', 'chroma-park'),
					'text' => _x('This is some text in the second sidebar.', 'Theme Starter Content', 'chroma-park')
				)
			)
		)
	)
));
}
add_action('after_setup_theme', 'chromapark_setup');
endif;

if (!function_exists('chromapark_register_menu')):
function chromapark_register_menu() { //registers the one menu, the header menu
 	register_nav_menu('header_menu', __('Header Menu', 'chroma-park') );
}
add_action( 'init', 'chromapark_register_menu' );
endif;

if (!function_exists('chromapark_stylesheet')):
function chromapark_stylesheet() { //enqueue stylesheets
	wp_enqueue_style('chroma-park-style', get_stylesheet_directory_uri().'/style.css');
	/* responsive design: */
	if (is_active_sidebar('left-sidebar')&&is_active_sidebar('right-sidebar')):
		wp_enqueue_style('chroma-park-mobile', get_stylesheet_directory_uri().'/mobile.css', array(), false, 'all and (max-width:899px)');
		//if there are two sidebars, use mobile stylesheet at width<900
	elseif (is_active_sidebar('left-sidebar')||is_active_sidebar('right-sidebar')):
		wp_enqueue_style('chroma-park-mobile', get_stylesheet_directory_uri().'/mobile.css', array(), false, 'all and (max-width:699px)');
		//if there is one sidebar, use mobile stylesheet at width<700
	else:
		wp_enqueue_style('chroma-park-mobile', get_stylesheet_directory_uri().'/mobile.css');
		//if there are no sidebars, use mobile stylesheet without width condition
	endif;
}

add_action('wp_enqueue_scripts', 'chromapark_stylesheet');
endif;

if (!function_exists('chromapark_sidebars')):
// register the sidebars
function chromapark_sidebars() {
	register_sidebar(array(
		'name' => __('First Sidebar', 'chroma-park'),
		'id' => 'left-sidebar'
	));

	register_sidebar(array(
		'name' => __('Second Sidebar', 'chroma-park'),
		'id' => 'right-sidebar'
	));
}

add_action('widgets_init', 'chromapark_sidebars');
endif;

if (!function_exists('chromapark_multiply_rgb')):
function chromapark_multiply_rgb($sixDHex, $multiplier) { /* function to multiply the red, green, blue values by the same amount, used in creation of stylesheets for custom colors */
	$rgbBits = hexdec(substr($sixDHex,1));
	$red = round($multiplier*(255 & ($rgbBits>>16)));
	$green = round($multiplier*(255 & ($rgbBits>>8)));
	$blue = round($multiplier*(255 & $rgbBits));
	return '#' . ($red<16?'0':'').dechex($red>255?255:$red) . ($green<16?'0':'').dechex($green>255?255:$green) . ($blue<16?'0':'').dechex($blue>255?255:$blue);
}
endif;

// add the customizable colors to the settings:
if (!function_exists('chromapark_customize_register')):
function chromapark_customize_register( $wp_customize ) {

	$wp_customize->add_setting('header_color',array(
		'default' => '#58830a',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color',
			array(
				'label' => __('Header Color', 'chroma-park'),
				'section' => 'colors'
			)
		)
	);

	$wp_customize->add_setting('content_color',array(
		'default' => '#58830a',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'content_color',
			array(
				'label' => __('Content Color', 'chroma-park'),
				'section' => 'colors'
			)
		)
	);

	$wp_customize->add_setting('left_sidebar_color',array(
		'default' => '#58830a',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'left_sidebar_color',
			array(
				'label' => __('First Sidebar Color', 'chroma-park'),
				'section' => 'colors'
			)
		)
	);

	$wp_customize->add_setting('right_sidebar_color',array(
		'default' => '#58830a',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'right_sidebar_color',
			array(
				'label' => __('Second Sidebar Color', 'chroma-park'),
				'section' => 'colors'
			)
		)
	);

	$wp_customize->add_setting('footer_color',array(
		'default' => '#58830a',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_color',
			array(
				'label' => __('Footer Color', 'chroma-park'),
				'section' => 'colors'
			)
		)
	);

}

add_action('customize_register','chromapark_customize_register');
endif;

if (!function_exists('chromapark_output_colors')):
/*function to actually display the colors*/
function chromapark_output_colors() {
	wp_register_style('chroma-park-custom-colors',false);
	$eighty_percent_content_color=chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.79);
	$custom_css = esc_html(
/*header coloring:*/
	'#header {background-color:' . get_theme_mod('header_color', '#58830a').';'.
	'border-color:'. get_theme_mod('header_color', '#58830a').' '.chromapark_multiply_rgb(get_theme_mod('header_color', '#58830a'),0.83).' '.chromapark_multiply_rgb(get_theme_mod('header_color', '#58830a'),0.65).'}'.
	'#header-menu-content a {color:'.chromapark_multiply_rgb(get_theme_mod('header_color', '#58830a'),0.5).'}'.
	'#header-menu-content a:hover, #header-menu-content a:focus, #header-menu-content a:active {color: #000}'.
/*content coloring:*/
	'#shortcut-content {color:'.get_theme_mod('content_color', '#58830a').'}'.
	'.sticky {background-image:linear-gradient('.(is_rtl()?'405':'315').'deg, '.get_theme_mod('content_color', '#58830a').', 27px, transparent, 30px, transparent)}'.
	'.meta {border-color:'.$eighty_percent_content_color.'}'.
	'#index-type {color:'.$eighty_percent_content_color.'}'.

	'.hentry .title a:link, .hentry .title a:visited, .hentry h1, .hentry h2, .hentry h3, .hentry h4, .hentry h5, .hentry h6 {color:'.$eighty_percent_content_color.'}'.
	'.hentry .title a:hover, .hentry .title a:active, .hentry .title a:focus {background-color:'.$eighty_percent_content_color.';color:#fff}'.

	'.hentry a:link, .readmore {color:'.get_theme_mod('content_color', '#58830a').'}'.
	'.hentry a:hover, .hentry a:active, .hentry a:focus {background-color:'.get_theme_mod('content_color', '#58830a').';color:#fff}'.
	'.is-style-outline .wp-block-button__link:hover, .is-style-outline .wp-block-button__link:focus, .is-style-outline .wp-block-button__link:active {background-color:transparent;border-color:'.get_theme_mod('content_color', '#58830a').';color:'.get_theme_mod('content_color', '#58830a').'}'.
	'.hentry code {border-top-color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),1.5).'}'.

	'.hentry .sticky .readmore a:link {color:'.$eighty_percent_content_color.'}'.
	'#comments {border-color:'.get_theme_mod('content_color', '#58830a').';'.
	'background-image:linear-gradient(to bottom,'.get_theme_mod('content_color', '#58830a').'c6, transparent, 130px, transparent)}'.
	'.reply-header, .comment-reply-title {color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.5).'}'.
	'.comment-feed-link a:link {color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.75).'}'.
	'.comment-feed-link a:hover, .comment-feed-link a:active, .comment-feed-link a:focus {background-color:'.$eighty_percent_content_color.';color:#fff}'.
	'.comment, .pingback, .trackback {background-color:'.get_theme_mod('content_color', '#58830a').'09}'.

	'#comments a:link {color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.75).'}'.
	'#comments a:hover, #comments a:focus, #comments a:active {background-color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.75).';color:#fff}'.
	'.commentlist h1, .commentlist h2, .commentlist h3, .commentlist h4, .commentlist h5, .commentlist h6 {color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.75).'}'.

	'.comment:hover,.comment:active,.comment:focus-within,.pingback:hover,.pingback:active,.pingback:focus-within,.trackback:hover,.trackback:active,.trackback:focus-within {border-color:'.get_theme_mod('content_color', '#58830a').'}'.
	'#content textarea:hover, #content button:hover, #content input:hover, #content select:hover, #content textarea:focus, #content button:focus, #content input:focus, #content select:focus, #content textarea:active, #content button:active, #content input:active, #content select:active {border-color:'.$eighty_percent_content_color.'}'.
	'#submit {background-color:'.$eighty_percent_content_color.';'.
	'background-image: linear-gradient(to bottom, transparent,'.get_theme_mod('content_color', '#58830a').')}'.
	'.nav-links a {color:'.chromapark_multiply_rgb(get_theme_mod('content_color', '#58830a'),0.5).'}'.
/*sidebar coloring:*/
	'#shortcut-left-sidebar {color:'.get_theme_mod('left_sidebar_color', '#58830a').'}'.
	'#left h2 {background-color:'.get_theme_mod('left_sidebar_color', '#58830a').';'.
	'border-color:'.chromapark_multiply_rgb(get_theme_mod('left_sidebar_color', '#58830a'),0.5).'}'.
	'#left li li {color:'.chromapark_multiply_rgb(get_theme_mod('left_sidebar_color', '#58830a'),0.65).'}'.
	'#left {background-image:linear-gradient(to bottom, '.get_theme_mod('left_sidebar_color', '#58830a').'8a, transparent, 95px, transparent)}'.
	'#left a:hover, #left a:active, #left a:focus {background-color:'.chromapark_multiply_rgb(get_theme_mod('left_sidebar_color', '#58830a'),0.7).'}'.
	'#left textarea:hover, #left button:hover, #left input:hover, #left select:hover, #left textarea:focus, #left button:focus, #left input:focus, #left select:focus, #left textarea:active, #left button:active, #left input:active, #left select:active {border-color:'.chromapark_multiply_rgb(get_theme_mod('left_sidebar_color', '#58830a'),0.79).'}'.

	'#shortcut-right-sidebar {color:'.get_theme_mod('right_sidebar_color', '#58830a').'}'.
	'#right h2 {background-color:'.get_theme_mod('right_sidebar_color', '#58830a').';'.
	'border-color:'.chromapark_multiply_rgb(get_theme_mod('right_sidebar_color', '#58830a'),0.5).'}'.
	'#right li li {color:'.chromapark_multiply_rgb(get_theme_mod('right_sidebar_color', '#58830a'),0.65).'}'.
	'#right {background-image:linear-gradient(to bottom, '.get_theme_mod('right_sidebar_color', '#58830a').'8a, transparent, 95px, transparent)}'.
	'#right a:hover, #right a:active, #right a:focus {background-color:'.chromapark_multiply_rgb(get_theme_mod('right_sidebar_color', '#58830a'),0.7).'}'.
	'#right textarea:hover, #right button:hover, #right input:hover, #right select:hover, #right textarea:focus, #right button:focus, #right input:focus, #right select:focus, #right textarea:active, #right button:active, #right input:active, #right select:active {border-color:'.chromapark_multiply_rgb(get_theme_mod('right_sidebar_color', '#58830a'),0.79).'}'.
/*footer coloring:*/
	'#footer {background-color:' . get_theme_mod('footer_color', '#58830a').';'.
	'border-color:'. get_theme_mod('footer_color', '#58830a').' '.chromapark_multiply_rgb(get_theme_mod('footer_color', '#58830a'),0.83).' '.chromapark_multiply_rgb(get_theme_mod('footer_color', '#58830a'),0.65).'}'.

	'#footer-content {color:'. chromapark_multiply_rgb(get_theme_mod('footer_color', '#58830a'),0.05) . '}'.
	'#footer-content a {color:'.chromapark_multiply_rgb(get_theme_mod('footer_color', '#58830a'),0.05).'}');

	wp_add_inline_style('chroma-park-custom-colors', $custom_css);
	wp_enqueue_style('chroma-park-custom-colors');
}

add_action('wp_enqueue_scripts', 'chromapark_output_colors');
endif;

// display information about a post under the post title
if (!function_exists('chromapark_post_meta')):
function chromapark_post_meta() {
	echo '<div class="meta">';
	if (get_post_type() == 'page'):
		printf(
		/* translators: %s = author */
			esc_html__('Posted by %s', 'chroma-park'),
			get_the_author()
		);
	elseif (has_category()):
		printf(
		/* translators: %1$s = date, %2$s = categories, %3$s = author */
			esc_html__('Posted on %1$s in %2$s by %3$s', 'chroma-park'),
			get_the_date(),
			wp_kses_post(get_the_category_list(',')),
			get_the_author()
		);
	else:
		printf(
		/* translators: %1$s = date, %2$s = author */
			esc_html__('Posted on %1$s by %2$s', 'chroma-park'),
			get_the_date(),
			get_the_author()
		);
	endif;
	edit_post_link(_x('Edit','verb','chroma-park'),' | ');
	if (get_post_type() != 'page' && has_tag()):
		echo '<br />';
		the_tags();
	endif;
	echo '</div>';
}
endif;

// change the archive title to show the search query when showing the archive title on a search result page.
if (!function_exists('chromapark_search_title')):
function chromapark_search_title($title) {
	if (is_search())
	/* translators: %s = search query */
		$title = sprintf(__('Search: %s', 'chroma-park'),get_search_query());
	return $title;
}

add_filter('get_the_archive_title', 'chromapark_search_title');
endif;
