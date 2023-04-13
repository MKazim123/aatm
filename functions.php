<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search_form' ) );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}
add_action( 'admin_notices', 'blankslate_admin_notice' );
function blankslate_admin_notice() {
$user_id = get_current_user_id();
if ( !get_user_meta( $user_id, 'blankslate_notice_dismissed_4' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p>' . __( '<big><strong>BlankSlate</strong>:</big> Help keep the project alive! <a href="?notice-dismiss" class="alignright">Dismiss</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">Make a Donation</a>', 'blankslate' ) . '</p></div>';
}
add_action( 'admin_init', 'blankslate_notice_dismissed' );
function blankslate_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['notice-dismiss'] ) )
add_user_meta( $user_id, 'blankslate_notice_dismissed_4', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'blankslate_enqueue' );
function blankslate_enqueue() {

	wp_enqueue_style('bootstrap-grid', get_template_directory_uri().'/css/bootstrap-grid.min.css');
	//wp_enqueue_style('lity', get_template_directory_uri().'/css/lity.min.css');
	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.min.css');
	wp_enqueue_style('nice-select', get_template_directory_uri().'/css/nice-select.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri().'/css/owl.carousel.min.css');
	wp_enqueue_style('owl-theme', get_template_directory_uri().'/css/owl.theme.default.min.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/css/slick.css');
	wp_enqueue_style('slick-theme', get_template_directory_uri().'/css/slick-theme.css');
	wp_enqueue_style('offer-page', get_template_directory_uri().'/css/offerpage.css');
	wp_enqueue_style('listing-page', get_template_directory_uri().'/css/listingpage.css');

	wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script('ajax-scripts', get_template_directory_uri() . '/js/ajax.js');
	wp_localize_script('ajax-scripts', 'ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));
	wp_enqueue_script('match-height', get_template_directory_uri().'/js/jquery.matchHeight-min.js', array('jquery'), '', true );
	//wp_enqueue_script('lity', get_template_directory_uri().'/js/lity.min.js', array('jquery'), '', true );
	wp_enqueue_script('owl-carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'), '', true );
	wp_enqueue_script('slick', get_template_directory_uri().'/js/slick.min.js', array('jquery'), '', true );
	wp_enqueue_script('nice-select', get_template_directory_uri().'/js/nice-select.js', array('jquery'), '', true );
	wp_enqueue_script('offer-listing-js', get_template_directory_uri().'/js/offer-listing.js', array('jquery'), '', true );
	wp_localize_script('offer-listing-js', 'ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'home_url' => home_url() ));

	wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery'), '', true );
}
add_action( 'wp_footer', 'blankslate_footer' );
function blankslate_footer() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'nav_menu_link_attributes', 'blankslate_schema_url', 10 );
function blankslate_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'blankslate_wp_body_open' ) ) {
function blankslate_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'blankslate_skip_link', 5 );
function blankslate_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
/*
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );
return $sizes;
}
*/
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function blankslate_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

if (function_exists('acf_add_options_page')){
  
  acf_add_options_page(array(
	'page_title'  => 'Theme Settings',
	'menu_title'  => 'Theme Settings',
	'menu_slug'   => 'theme-settings'
  ));
}


function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


function tel($phone) {

	echo str_replace(array("-", " ", ".", "_", ")", "("), "", $phone);
}

function bread() {
	echo '<span class="crumb"><svg xmlns="http://www.w3.org/2000/svg" width="4.574" height="8" viewBox="0 0 4.574 8"><path id="Path_213" data-name="Path 213" d="M2.649,133.547l.358.358a.217.217,0,0,0,.307,0l3.272-3.264L9.858,133.9a.217.217,0,0,0,.307,0l.358-.358a.217.217,0,0,0,0-.307l-3.783-3.783a.217.217,0,0,0-.307,0L2.649,133.24A.217.217,0,0,0,2.649,133.547Z" transform="translate(133.968 -2.586) rotate(90)" fill="#251e31"/></svg></span>';
}

function social() {

	$icons = ['', '<svg xmlns="http://www.w3.org/2000/svg" width="40.202" height="39.958" viewBox="0 0 40.202 39.958">  <path d="M48.2,28.1A20.1,20.1,0,1,0,24.96,47.958V33.911H19.854V28.1H24.96V23.672c0-5.037,3-7.82,7.592-7.82a30.935,30.935,0,0,1,4.5.392v4.944H34.517c-2.5,0-3.275,1.55-3.275,3.139V28.1h5.575l-.892,5.811H31.242V47.958A20.108,20.108,0,0,0,48.2,28.1Z" transform="translate(-8 -8)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="39.958" height="39.958" viewBox="0 0 39.958 39.958">  <path d="M19.979,0A19.979,19.979,0,1,1,0,19.979,19.982,19.982,0,0,1,19.979,0ZM15.3,9.013h9.348A6.356,6.356,0,0,1,31.029,15.3v9.324a6.348,6.348,0,0,1-6.376,6.292H15.3a6.348,6.348,0,0,1-6.376-6.292V15.3A6.356,6.356,0,0,1,15.3,9.013Zm4.614,5.046a6.184,6.184,0,1,1-6.184,6.184A6.184,6.184,0,0,1,19.919,14.059Zm0,2.085a4.087,4.087,0,1,1-4.087,4.087A4.092,4.092,0,0,1,19.919,16.144ZM25.9,13.2A1.007,1.007,0,1,1,24.893,14.2,1.005,1.005,0,0,1,25.9,13.2Zm-9.828-2.4h7.814a5.332,5.332,0,0,1,5.333,5.309V23.97a5.332,5.332,0,0,1-5.333,5.309H16.072a5.332,5.332,0,0,1-5.333-5.309V16.108A5.332,5.332,0,0,1,16.072,10.8Z" fill-rule="evenodd"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="39.958" height="39.958" viewBox="0 0 39.958 39.958">  <path d="M19.979,0A19.979,19.979,0,1,1,0,19.979,19.982,19.982,0,0,1,19.979,0Zm4.327,8.917c.372,3.14,2.121,5.01,5.154,5.2v3.524a8.143,8.143,0,0,1-5.106-1.486v6.592c0,8.39-9.145,11-12.812,5-2.361-3.859-.911-10.655,6.664-10.918v3.727a11.3,11.3,0,0,0-1.75.431c-1.69.563-2.637,1.642-2.373,3.524.515,3.608,7.131,4.674,6.58-2.373V8.929h3.655Z" fill-rule="evenodd"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="39.96" height="39.96" viewBox="0 0 39.96 39.96">  <path id="pinterest" d="M39.96,27.98A19.982,19.982,0,0,1,14.067,47.066a22.459,22.459,0,0,0,2.481-5.237c.242-.935,1.241-4.753,1.241-4.753a5.351,5.351,0,0,0,4.576,2.3c6.026,0,10.369-5.543,10.369-12.431,0-6.6-5.39-11.537-12.318-11.537-8.62,0-13.2,5.785-13.2,12.093,0,2.933,1.563,6.582,4.052,7.742.379.177.58.1.669-.266.064-.274.4-1.635.556-2.264a.6.6,0,0,0-.137-.572,7.868,7.868,0,0,1-1.474-4.56A8.646,8.646,0,0,1,19.9,18.908c4.906,0,8.346,3.343,8.346,8.129,0,5.406-2.731,9.152-6.284,9.152a2.9,2.9,0,0,1-2.957-3.609c.564-2.377,1.652-4.939,1.652-6.655a2.509,2.509,0,0,0-2.53-2.812c-2.006,0-3.617,2.071-3.617,4.85a7.2,7.2,0,0,0,.6,2.965s-1.974,8.363-2.336,9.926A19.34,19.34,0,0,0,12.7,46.59,19.982,19.982,0,1,1,39.96,27.98Z" transform="translate(0 -8)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="39.958" height="39.958" viewBox="0 0 39.958 39.958">  <path d="M19.979,0A19.979,19.979,0,1,1,0,19.979,19.982,19.982,0,0,1,19.979,0ZM30.922,15.509a4.784,4.784,0,0,0-.887-2.217,3.206,3.206,0,0,0-2.241-.947c-3.128-.228-7.814-.228-7.814-.228h-.012s-4.7,0-7.814.228a3.206,3.206,0,0,0-2.241.947,4.784,4.784,0,0,0-.887,2.217,33.227,33.227,0,0,0-.228,3.62v1.69a33.227,33.227,0,0,0,.228,3.62,4.784,4.784,0,0,0,.887,2.217,3.831,3.831,0,0,0,2.469.959c1.786.168,7.6.228,7.6.228s4.7-.012,7.826-.228a3.206,3.206,0,0,0,2.241-.947,4.784,4.784,0,0,0,.887-2.217,33.228,33.228,0,0,0,.228-3.62V19.14a33.228,33.228,0,0,0-.228-3.62ZM17.654,22.88V16.6l6.04,3.152Z" fill-rule="evenodd"/></svg>','<svg xmlns="http://www.w3.org/2000/svg" width="494" height="494" viewBox="0 0 494 494"><path id="Path_1" data-name="Path 1" d="M250,3C113.6,3,3,113.6,3,250S113.6,497,250,497,497,386.4,497,250,386.4,3,250,3ZM387.5,196.6c.2,2.8.2,5.7.2,8.5,0,87-66.2,187.2-187.2,187.2a185.987,185.987,0,0,1-101-29.5,138.762,138.762,0,0,0,15.9.8,131.827,131.827,0,0,0,81.7-28.1,65.918,65.918,0,0,1-61.5-45.6,85.225,85.225,0,0,0,12.4,1,70.7,70.7,0,0,0,17.3-2.2,65.891,65.891,0,0,1-52.8-64.6v-.8a67.334,67.334,0,0,0,29.7,8.4,65.842,65.842,0,0,1-20.3-88,187.408,187.408,0,0,0,135.7,68.9,75.872,75.872,0,0,1-1.6-15.1,65.865,65.865,0,0,1,113.9-45,127.524,127.524,0,0,0,41.8-15.9,66.016,66.016,0,0,1-28.9,36.3,131.166,131.166,0,0,0,37.9-10.2A150.412,150.412,0,0,1,387.5,196.6Z" transform="translate(-3 -3)" fill="#3a1bff"/></svg>'];
	$links = get_field('social_links', 'options');

	echo "<div class='social flex'>";
	for ($i = 1; $i <= 6; $i ++)
		if (($url = $links['social_'.$i]))
			echo '<a href="' .$url. '" target="_blank">' .$icons[$i]. '</a>';
	echo '</div>';
}

function share () {
	$icons = ['<svg xmlns="http://www.w3.org/2000/svg" width="20.122" height="20" viewBox="0 0 20.122 20"><path d="M28.122,18.061A10.061,10.061,0,1,0,16.489,28V20.969H13.933V18.061h2.556V15.844a3.55,3.55,0,0,1,3.8-3.914,15.483,15.483,0,0,1,2.252.2V14.6H21.272a1.454,1.454,0,0,0-1.639,1.571v1.888h2.79l-.446,2.908H19.633V28A10.064,10.064,0,0,0,28.122,18.061Z" transform="translate(-8 -8)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M13,3A10,10,0,1,0,23,13,10,10,0,0,0,13,3Zm5.567,7.838c.008.113.008.231.008.344A7.583,7.583,0,0,1,6.907,17.567a5.618,5.618,0,0,0,.644.032,5.337,5.337,0,0,0,3.308-1.138,2.669,2.669,0,0,1-2.49-1.846,3.45,3.45,0,0,0,.5.04,2.862,2.862,0,0,0,.7-.089,2.668,2.668,0,0,1-2.138-2.615v-.032a2.726,2.726,0,0,0,1.2.34A2.666,2.666,0,0,1,7.814,8.7a7.587,7.587,0,0,0,5.494,2.789,3.072,3.072,0,0,1-.065-.611,2.667,2.667,0,0,1,4.611-1.822,5.163,5.163,0,0,0,1.692-.644,2.673,2.673,0,0,1-1.17,1.47,5.31,5.31,0,0,0,1.534-.413A6.09,6.09,0,0,1,18.567,10.838Z" transform="translate(-3 -3)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M20,18A10,10,0,0,1,7.04,27.552a11.241,11.241,0,0,0,1.242-2.621c.121-.468.621-2.379.621-2.379a2.678,2.678,0,0,0,2.29,1.149c3.016,0,5.19-2.774,5.19-6.222a5.869,5.869,0,0,0-6.165-5.774c-4.315,0-6.609,2.9-6.609,6.052,0,1.468.782,3.294,2.028,3.875.19.089.29.048.335-.133.032-.137.2-.819.278-1.133a.3.3,0,0,0-.069-.286A3.938,3.938,0,0,1,5.444,17.8,4.327,4.327,0,0,1,9.96,13.46a3.948,3.948,0,0,1,4.177,4.069c0,2.706-1.367,4.581-3.145,4.581A1.45,1.45,0,0,1,9.512,20.3a20.094,20.094,0,0,0,.827-3.331,1.256,1.256,0,0,0-1.266-1.407c-1,0-1.81,1.036-1.81,2.427a3.6,3.6,0,0,0,.3,1.484s-.988,4.185-1.169,4.968a9.68,9.68,0,0,0-.036,2.871A10,10,0,1,1,20,18Z" transform="translate(0 -8)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12.758,7.241a5.934,5.934,0,0,1,.014,8.382l-.014.014-2.625,2.625a5.937,5.937,0,0,1-8.4-8.4L3.185,8.417a.624.624,0,0,1,1.066.414,7.2,7.2,0,0,0,.379,2.059.629.629,0,0,1-.148.649l-.511.511a2.813,2.813,0,1,0,3.952,4l2.625-2.625a2.812,2.812,0,0,0,0-3.978,2.926,2.926,0,0,0-.4-.335.626.626,0,0,1-.271-.492A1.556,1.556,0,0,1,10.33,7.46l.822-.822a.628.628,0,0,1,.8-.068,5.956,5.956,0,0,1,.8.672Zm5.505-5.506a5.944,5.944,0,0,0-8.4,0L7.241,4.361l-.014.014a5.939,5.939,0,0,0,.816,9.054.628.628,0,0,0,.8-.068l.822-.822a1.556,1.556,0,0,0,.457-1.164.626.626,0,0,0-.271-.492,2.926,2.926,0,0,1-.4-.335,2.812,2.812,0,0,1,0-3.978l2.625-2.625a2.813,2.813,0,1,1,3.952,4l-.511.511a.629.629,0,0,0-.148.649,7.2,7.2,0,0,1,.379,2.059.624.624,0,0,0,1.066.414l1.449-1.449a5.944,5.944,0,0,0,0-8.4Z" transform="translate(0 0)" fill="#3a1bff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" width="26.667" height="20" viewBox="0 0 26.667 20"><path d="M.505,70.6A.314.314,0,0,0,0,70.849V81.5A2.5,2.5,0,0,0,2.5,84H24.167a2.5,2.5,0,0,0,2.5-2.5V70.854a.311.311,0,0,0-.505-.245c-1.167.906-2.714,2.057-8.026,5.917-1.1.8-2.953,2.49-4.8,2.479-1.859.016-3.75-1.708-4.807-2.479C3.214,72.667,1.672,71.51.505,70.6Zm12.828,6.729c-1.208.021-2.948-1.521-3.823-2.156C2.6,70.161,2.073,69.724.479,68.474A1.246,1.246,0,0,1,0,67.49V66.5A2.5,2.5,0,0,1,2.5,64H24.167a2.5,2.5,0,0,1,2.5,2.5v.99a1.254,1.254,0,0,1-.479.984c-1.594,1.245-2.12,1.688-9.031,6.7C16.281,75.813,14.542,77.354,13.333,77.333Z" transform="translate(0 -64)" fill="#3a1bff"/></svg>'];

	echo '
	<!-- AddToAny BEGIN -->
	<div class="a2a_kit fc">
		<p>Share: </p>
		<a class="a2a_button_facebook">' .$icons[0]. '</a>
		<a class="a2a_button_twitter">' .$icons[1]. '</a>
		<a class="a2a_button_pinterest">' .$icons[2]. '</a>
		<a class="a2a_button_copy_link">' .$icons[3]. '</a>
		<a class="a2a_button_email">' .$icons[4]. '</a>
	</div>
	<script async src="https://static.addtoany.com/menu/page.js"></script>
	<!-- AddToAny END -->';
}

 function my_mce4_options($init) {
  $default_colours = '
  "000000", "Black",
  "993300", "Burnt orange",
  "333300", "Dark olive",
  "003300", "Dark green",
  "003366", "Dark azure",
  "333399", "Indigo",
  "333333", "Very dark gray",
  "800000", "Maroon",
  "FF6600", "Orange",
  "808000", "Olive",
  "008000", "Green",
  "008080", "Teal",
  "666699", "Grayish blue",
  "808080", "Gray",
  "FF0000", "Red",
  "FF9900", "Amber",
  "99CC00", "Yellow green",
  "339966", "Sea green",
  "33CCCC", "Turquoise",
  "999999", "Medium gray",
  "FFCC00", "Gold",
  "FFFF00", "Yellow",
  "00FF00", "Lime",
  "00FFFF", "Aqua",
  "00CCFF", "Sky blue",
  "993366", "Red violet",
  "FFFFFF", "White",
  "FFCC99", "Peach",
  "FFFF99", "Light yellow",
  "CCFFCC", "Pale green",
  "CCFFFF", "Pale cyan",
  "99CCFF", "Light sky blue"';

  	$custom_colours =  '
	"1e08a8", "Dark Blue",
	"3a1bff", "Blue",
	"e6e6fa", "Purple",
	"f0d8e5", "Pink",
	"f084f4", "Bight Pink"';
	

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');


/*
* Functions to add view counters and display the value in the Admin's Posts overview
*
* Code base found at https://www.isitwp.com/track-post-views-without-a-plugin-using-post-meta/
*/

function get_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 Views";
	}
	if ($count=='1') {
	  return "1 View";
	}
	return $count.' Views';
}

function set_post_views($postID) {
	// Only count views on published posts
	if (get_post_status($postID) !== 'publish'){
		return;
	}

	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count=='') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

// Add to a column in WP-Admin
function posts_column_views($defaults) {
	$defaults['post_views'] = __('Views');
	return $defaults;
}

function posts_custom_column_views($column_name, $id) {
	if($column_name === 'post_views'){
		echo get_post_views(get_the_ID());
	}
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);

/*
* End of view counter functions; see also single.php for changes
*/

function reset_posts_views($postType="post") {

	$posts = get_posts ([
		'post_type' => $postType,
		'posts_per_page' => -1
	]);

	foreach ($posts as $post) {

		$postID = $post->ID;
		$count_key = 'post_views_count';
		update_post_meta($postID, $count_key, '0');		
	}
}

//reset_posts_views('post');

function admin_reset_counter($hook) {
	if ( 'toplevel_page_theme-settings' != $hook ) {
		return;
	}
	wp_enqueue_script('ajax-scripts', get_template_directory_uri() . '/js/admin.js');
}
add_action( 'admin_enqueue_scripts', 'admin_reset_counter' );
/* ?>
<form id="reset_form">
	<input type="hidden" id="ptype" name="ptype" value="post" />
	<input type="hidden" name="action" value="reset_form" />
	<?php wp_nonce_field('reset_form'); ?>
</form>

<?php
*/
//Here, we're only checking if the POST data has been sent through
//so we can outsource the logic to the refreshCache function

if (isset($_POST['reset-post'])) {
	reset_posts_views($_POST['reset-post']);
}

if (isset($_POST['reset-offers'])) {
	reset_posts_views($_POST['reset-offers']);
}

function reset_form() {

	check_ajax_referer('reset_form', 'security');

	$ptype = $_POST['ptype'];
	
	$html = 'The views for ' . ($ptype == 'post') ? 'posts' : 'offers' . 'have been reset.';
	
	$response['msg'] = $html;	
	wp_send_json($response);
	die();
}

add_action('wp_ajax_nopriv_reset_form', 'reset_form');
add_action('wp_ajax_reset_form', 'reset_form');


function wpshout_longer_excerpts( $length ) {
	// Don't change anything inside /wp-admin/
	if ( is_admin() ) {
		return $length;
	}
	// Set excerpt length to 20 words
	return 20;
	}
// "999" priority makes this run last of all the functions hooked to this filter, meaning it overrides them
add_filter( 'excerpt_length', 'wpshout_longer_excerpts', 999 );

function wpshout_change_and_link_excerpt( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	// Change text, make it link, and return change
	return '';
 }
 add_filter( 'excerpt_more', 'wpshout_change_and_link_excerpt', 999 );


function custom_pagination($numpages = '', $pagerange = '', $pagedd, $echo=true) {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  //global $paged;
  if (empty($pagedd)) {
    $pagedd = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $pagedd,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<i class="tr fas fa-chevron-left"></i>'),
    'next_text'       => __('<i class="tr fas fa-chevron-right"></i>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    $nav = "<nav class='custom-pagination fcc'>";
      $nav.= $paginate_links;
    $nav.= "</nav>";
    if ($echo)
      echo $nav;
    else 
      return $nav;
  }
} 

function load_template_part($template_name, $part_name=null) {
	ob_start();
	get_template_part($template_name, $part_name);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

function get_categories_parent_id ($catid) {
	while ($catid) {
		$cat = get_category($catid); // get the object for the catid
		$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
		$catParent = $cat->cat_ID;
	}
	return $catParent;
}

add_filter( 'relevanssi_modify_wp_query', 'rlv_adjust_search' );
function rlv_adjust_search( $query ) {
  $query->set( 'cat', $cat ); 
  return $query;
}


add_filter( 'gform_display_add_form_button', function(){return false;} );

function search_form() {

	check_ajax_referer('search_form', 'security');

	$paged = $_POST['paged'];
	$pagedNext = $paged + 1;
	$cat = $_POST['cat'];
	$many = $_POST['many'];
	$search = $_POST['searchfor'];

	$args = [
		's'=> $search,
		'cat' => $cat,
		'paged' => $paged,
		'post_type' => 'post',
		'posts_per_page' => 24
	];

	$argsNext = [
		's'=> $search,
		'cat' => $cat,
		'paged' => $pagedNext,
		'post_type' => 'post',
		'posts_per_page' => 24
	];
	if (!$many) {

		$args = [
			's'=> '',
			'post_type' => 'post',
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'paged' => $paged,
			'post_type' => 'post',
			'posts_per_page' => 12
		];

		$argsNext = [
			's'=> '',
			'post_type' => 'post',
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'paged' => $pagedNext,
			'post_type' => 'post',
			'posts_per_page' => 12
		];
	}

	//query_posts($args);

	$loop = new WP_Query();
	$loop->parse_query($args);
	relevanssi_do_query($loop);

	$loopNext = new WP_Query();
	$loopNext->parse_query($argsNext);
	relevanssi_do_query($loopNext);
		
	if ($loop->have_posts()):
		$custom_query = new WP_Query($args);
		$count = $loop->found_posts;
		$html = '';
		while ($loop->have_posts()): $loop->the_post();
			$html.= load_template_part("templates/part", "post");
		endwhile;
	endif;
	wp_reset_query();

	query_posts($argsNext);
	if (!$loopNext->have_posts()):
		$moreBtn = '';
	else:
		$moreBtn = '<button class="btn">load more</button>';
	endif;
	
	wp_reset_query();
	$response['results'] = $html;
	$response['paged'] = $paged;
	$response['more'] = $moreBtn;
	$response['count'] = $count;
	$response['many'] = $many;
	wp_send_json($response);
	die();
}

add_action('wp_ajax_nopriv_search_form', 'search_form');
add_action('wp_ajax_search_form', 'search_form');


function more_form() {

	check_ajax_referer('more_form', 'security');

	$paged = $_POST['paged'];
	$pagedNext = $paged + 1;
	$cat = $_POST['cat'];
	$ignore = $_POST['ignore'];

	$args = [
		'cat' => $cat,
		'paged' => $paged,
		'posts_per_page' => 12
	];
	/*'post__not_in' => explode(',', $ignore),*/

	$argsNext = [
		'cat' => $cat,
		'paged' => $pagedNext,
		'posts_per_page' => 12
	];
	/*'post__not_in' => explode(',', $ignore),*/

	query_posts($args);
		
	if (have_posts()):
	global $wp_query;
	$custom_query = new WP_Query($args);
	$html = '';
	while (have_posts()): the_post();
		$html.= load_template_part("templates/part", "post");
	endwhile;	

	endif;
	wp_reset_query();

	query_posts($argsNext);
	if (!have_posts()):
		$moreBtn = '';
	else:
		$moreBtn = '<button class="btn">load more</button>';
	endif;
	
	wp_reset_query();
	$response['results'] = $html;
	$response['paged'] = $paged;
	$response['more'] = $moreBtn;
	wp_send_json($response);
	die();
}

add_action('wp_ajax_nopriv_more_form', 'more_form');
add_action('wp_ajax_more_form', 'more_form');


function offer_form() {

	check_ajax_referer('offer_form', 'security');

	$paged = $_POST['paged'];
	$meta_key = $_POST['meta_key'];
	$orderby = $_POST['orderby'];
	$order = $_POST['order'];
	$ages_stages = $_POST['ages_stages'];
	$offer_category = $_POST['offer_category'];
	$brand = $_POST['brand'];	

	$tax = ['relation' => 'OR'];
	$meta = ['relation' => 'OR'];

	if (isset($_POST['ages_stages']))
		$tax[] = [
     'taxonomy' => 'ages_stages',
     'field' => 'term_id',
     'terms' => $ages_stages
  ];
	if (isset($_POST['brand']))
		$tax[] = [
     'taxonomy' => 'brand',
     'field' => 'term_id',
     'terms' => $brand
  ];
	if (isset($_POST['offer_category']))
		$tax[] = [
     'taxonomy' => 'offer_category',
     'field' => 'term_id',
     'terms' => $offer_category
  ];
	if (isset($_POST['show_featured']))
		$meta[] = [
     'key' => 'featured',
     'value' => '1',
     'compare' => '='
  ];
	if (isset($_POST['show_last']))
		$meta[] = [
     'key' => 'last_chance',
     'value' => '1',
     'compare' => '='
  ];
	

	$args = [
		'post_type' => 'offers',
		'posts_per_page' => 24,
		'paged' => $paged,
		'meta_key' => $meta_key,
		'orderby' => $orderby,
		'order' => $order,
		'tax_query' => $tax,
		'meta_query' => $meta
	];

	query_posts($args);
		
	if (have_posts()):
		global $wp_query;
		$custom_query = new WP_Query($args);
		$html = '';
		while (have_posts()): the_post();
			$html.= load_template_part("templates/part", "offer");
		endwhile;
		$pagination = '';
		if ($paged):
			$pagination = custom_pagination($wp_query->max_num_pages, "", $paged, false);
		endif;
	else:
		$html = '<h4 class="no-offers col-12">Sorry, we couldn\'t find anything.</h4>';
	endif;
	wp_reset_query();
	
	wp_reset_query();
	$response['results'] = $html;
	$response['paged'] = $paged;
	$response['args'] = $args;
	$response['pagination'] = $pagination;
	$response['count'] = $custom_query->found_posts;
	wp_send_json($response);
	die();
}

add_action('wp_ajax_nopriv_offer_form', 'offer_form');
add_action('wp_ajax_offer_form', 'offer_form');



 add_action('admin_init', 'newsletter_form_shortcode_init');
 function newsletter_form_shortcode_init() {

	  if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
		   return;

	  add_filter("mce_external_plugins", "register_tinymce_plugin"); 

	  add_filter('mce_buttons', 'add_tinymce_button');
}


function register_tinymce_plugin($plugin_array) {
	$plugin_array['newsletter_form'] = get_stylesheet_directory_uri() . '/js/shortcode.js';
	return $plugin_array;
}

function add_tinymce_button($buttons) {
	$buttons[] = "newsletter_form";
	return $buttons;
}

function newsletter_form_callback( $atts, $content = null ) {
	/*
	$a = shortcode_atts( array(
		'url' => '',
		'color' => '',
		'style' => '',
		'icon' => '',
	), $atts );
	$color = ($a['color']) ? " button-" . $a['color'] : "";
	$style = ($a['style']) ? " button-" . $a['style'] : "";
	return '<a class="button ' . $color . $style . ' " href="' . $a['url'] . '">' . $content . '</a>';*/
	$nl = get_field('newsletter_module', 'options');
	$return =
	'<section class="newsletter_module newsletter_inline">
		<div class="overlay bg" style="background-image: url('. $nl['background_pattern']['sizes']['1536x1536'] .');"></div>
		<div class="fc">' .
		    wp_get_attachment_image($nl['icon'], 'medium').'
		    <div>
				<h3>'.$nl['headline'].'</h3>
				<p>'.$nl['text'].'</p>
			</div>'.
			do_shortcode('[gravityform id="8" title="false" description="false" ajax="true"]').'
		</div>
	</section>';
	return $return;
}
add_shortcode( 'newsletter_form', 'newsletter_form_callback' );




/*
add_filter('acf/location/rule_types', 'acf_location_rules_types', 999);
function acf_location_rules_types($choices) {
    // create a new group for the rules called Terms
    // if it does not already exist
    if (!isset($choices['Terms'])) {
        $choices['Terms'] = array();
    }
    // create new rule type in the new group
    $choices['Terms']['category_id'] = 'Category';
    return $choices;
}

add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices) {
    // get terms and build choices
    $taxonomy = 'category';
    $args = array('hide_empty' => false);
    $terms = get_terms($taxonomy, $args);
    if (count($terms)) {
        foreach ($terms as $term) {
            $choices[$term->term_id] = $term->name;
        }
    }
    return $choices;
}

add_filter('acf/location/rule_match/category_id', 'acf_location_rules_match_category', 10, 3);
function acf_location_rules_match_category($match, $rule, $options) {
    if (!isset($_GET['tag_ID']) || 
            !isset($_GET['taxonomy']) || 
            $_GET['taxonomy'] != 'category') {
        // bail early
        return $match;
    }
    $term_id = $_GET['tag_ID'];
    $selected_term = $rule['value'];
    if ($rule['operator'] == '==') {
        $match = ($selected_term == $term_id);
    } elseif ($rule['operator'] == '!=') {
        $match = ($selected_term != $term_id);
    }
    return $match;
}
*/



// New offers code

add_action ('wp_head','vt_styles_head');
function vt_styles_head() {
    ?>
	<style>
		.vt-coupons-cards .vt-card .vt-card-footer a:after {
			background-image: url("<?php echo home_url('/wp-content/uploads/2022/11/Vector-3.png'); ?>");
		}
		.vt-section .vt-sec-right .vt-offer-listing-cards .vt-card .vt-card-btn a::after{
			background-image: url("<?php echo home_url('/wp-content/uploads/2022/11/Group-238201-1.png'); ?>");
		}
	</style>
	<?php
}

add_action( 'wp_ajax_get_brands_from_category', 'get_brands_from_category_funt' );
add_action( 'wp_ajax_nopriv_get_brands_from_category', 'get_brands_from_category_funt' );
function get_brands_from_category_funt(){
	global $wpdb;
	$offer_category = $_POST['offer_category'] ? $_POST['offer_category'] : "";
	$data_to_return = '<option value="">Please Select Brand</option>';
	$brand_term_array = array();
	$args = array(
		'post_type' => 'offers',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'offer_category',
				'field'    => 'slug',
				'terms'    => $offer_category,
			),
		),
	);
	$offers_query = new WP_Query( $args );
	while(  $offers_query->have_posts()){
		$offers_query->the_post();
		$brand_terms = wp_get_post_terms( get_the_ID(), "brand" );
		foreach ( $brand_terms as $brand_term ){
			array_push($brand_term_array, $brand_term->name.'|'.$brand_term->term_id);
			
		}
	}
	wp_reset_postdata();
	$unique_brand_term_array = array_unique($brand_term_array);
	foreach($unique_brand_term_array as $unique_brand_term){
		$unique_brand_term_ex = explode('|', $unique_brand_term);
		$data_to_return .= '<option value="'.$unique_brand_term_ex[1].'">'.$unique_brand_term_ex[0].'</option>';
	}

	echo $data_to_return;
    die();
}

add_action( 'wp_ajax_brand_order_by', 'brand_order_by_funt' );
add_action( 'wp_ajax_nopriv_brand_order_by', 'brand_order_by_funt' );
function brand_order_by_funt(){
	global $wpdb;
	$brand_order_by = $_POST['brand_order_by'] ? $_POST['brand_order_by'] : "";
	$data_to_return = "";
	if($brand_order_by == "a-z"){
		$total_brands = wp_count_terms('brand', array('hide_empty'=> true));
		$number = 12;
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$taxonomy = 'brand';
		$offset = $page ? $number * ($page - 1):0;
		$args = array( 'post_per_page' => 12,'orderby' => 'title','order'=> 'ASC' ,'number' => $number, 'offset' => $offset );
		$brand_terms = get_terms( $taxonomy, $args );
		// echo '<pre>';
		// print_r($brand_terms);
		// echo "</pre>";
		foreach($brand_terms as $brand_term){
			$brand_image = get_field('brand_image', 'brand_'.$brand_term->term_id) ? get_field('brand_image', 'brand_'.$brand_term->term_id) : home_url("/wp-content/uploads/2022/11/brand.png");
			$brand_description = $brand_term->description ? $brand_term->description : "Zen Sleapwear | Nested Bean shop now";
			$data_to_return .= '
			<div class="vt-card">
				<div class="vt-card-head"></div>
				<div class="vt-card-body">
					<div class="vt-brand-logo">
						<img src="'.$brand_image.'" alt="">
					</div>
					<div class="vt-brand-meta">
						<h3 class="vt-card-heading">'.$brand_term->name.'</h3>
						<div class="vt-card-desp">
							<p>'.$brand_description.'</p>
						</div>
					</div>
				</div>
				<div class="vt-card-footer">
					<a href="'.home_url("/listing?b=".$brand_term->term_id).'" class="vt-card-btn">Get The Offer</a>
				</div>
			</div>
			';
		}
	}
	else{
		$total_brands = wp_count_terms('brand', array('hide_empty'=> true));
		$number = 12;
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$taxonomy = 'brand';
		$offset = $page ? $number * ($page - 1):0;
		$args = array( 'post_per_page' => 12,'orderby' => 'title','order'=> 'DESC' ,'number' => $number, 'offset' => $offset );
		$brand_terms = get_terms( $taxonomy, $args );
		// echo '<pre>';
		// print_r($brand_terms);
		// echo "</pre>";
		foreach($brand_terms as $brand_term){
			$brand_image = get_field('brand_image', 'brand_'.$brand_term->term_id) ? get_field('brand_image', 'brand_'.$brand_term->term_id) : home_url("/wp-content/uploads/2022/11/brand.png");
			$brand_description = $brand_term->description ? $brand_term->description : "Zen Sleapwear | Nested Bean shop now";
			$data_to_return .= '
			<div class="vt-card">
				<div class="vt-card-head"></div>
				<div class="vt-card-body">
					<div class="vt-brand-logo">
						<img src="'.$brand_image.'" alt="">
					</div>
					<div class="vt-brand-meta">
						<h3 class="vt-card-heading">'.$brand_term->name.'</h3>
						<div class="vt-card-desp">
							<p>'.$brand_description.'</p>
						</div>
					</div>
				</div>
				<div class="vt-card-footer">
					<a href="'.home_url("/listing?b=".$brand_term->term_id).'" class="vt-card-btn">Get The Offer</a>
				</div>
			</div>
			';
		}
	}
	
	echo $data_to_return;
	die();
}





// advance search
add_action( 'wp_ajax_offer_brand_search_action', 'offer_brand_search_funt' );
add_action( 'wp_ajax_nopriv_offer_brand_search_action', 'offer_brand_search_funt' );
function offer_brand_search_funt(){
	global $wpdb;
	$search_val = $_POST['search_val'] ? $_POST['search_val'] : "";
	$taxonomy = 'brand';
	$data_to_return = "";
	$offers_to_return = "";
	$brands_to_return = "";
	$args = array(
		'post_type' => 'offers',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		's' => $search_val
	);
	$offers_query = new WP_Query( $args );
	while(  $offers_query->have_posts()){
		$offers_query->the_post();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-offer-thumbnail' );
		$offer_button = get_field('lasso_shortcode') ? do_shortcode(get_field('lasso_shortcode')) : '<a href="javascript:void(0)" class="lasso-button-1">get it now!</a>';
		$offers_to_return .= '
			<li class="search_item">
				<div class="search_item_row">
					<img src="'.$image[0].'" alt="">
					<span>'.get_the_title().'</span>
					'.$offer_button.'
				</div>
			</li>
		';
	}
	wp_reset_postdata();

	// $args_brand = array( 
	// 	'post_per_page' => 5,
	// 	's' => $search_val
	// );
	$args_brand = array(
		'taxonomy'      => array( 'brand' ), // taxonomy name
		'orderby'       => 'id', 
		'order'         => 'ASC',
		'hide_empty'    => true,
		'fields'        => 'all',
		'number' => 5,
		'name__like'    => $search_val
	); 
    $brand_terms = get_terms( $args_brand );
	foreach($brand_terms as $brand_term){
		$brand_image = get_field('brand_image', 'brand_'.$brand_term->term_id) ? get_field('brand_image', 'brand_'.$brand_term->term_id) : home_url("/wp-content/uploads/2022/11/brand.png");
		$brand_description = $brand_term->description ? $brand_term->description : "Zen Sleapwear | Nested Bean shop now";
		$brands_to_return .= '
			<li class="search_item">
				<a href="'.home_url("/listing?b=".$brand_term->term_id).'" class="search_item_row">
					<img src="'.$brand_image.'" alt="">
					<span>'.$brand_term->name.'</span>
				</a>
			</li>
		';
	}
	echo $offers_to_return.'|||'.$brands_to_return;
	die();
}