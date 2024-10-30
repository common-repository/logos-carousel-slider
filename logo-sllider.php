<?php
/*
Plugin Name: Logos Carousel Slider
Plugin URI: http://inboxtech.in/
Description: Logos Carousel Slider
Version: 1.0
Author: Inbox Technology
Author URI: https://profiles.wordpress.org/kartikdholariya/
License: GPLv2 or later
Text Domain: http://inboxtech.in/
*/

function inboxlogo_script_add_on_slider() {
	wp_register_style( 'crousel-style',  plugin_dir_url(__FILE__).'css/carousel.css');
	wp_enqueue_style( 'crousel-style' );
	wp_enqueue_script( 'slick-ajax-js', plugin_dir_url(__FILE__).'js/slick-ajax.js' );
	wp_enqueue_script( 'slick-ajax-js' );
	wp_register_script( 'slick-script',plugin_dir_url(__FILE__).'js/slick.js' );
	wp_enqueue_script( 'slick-script' );
}
add_action('wp_enqueue_scripts', 'inboxlogo_script_add_on_slider');

function inboxlogo_logocarousel_pages(){
    add_submenu_page('edit.php?post_type=logocrowsalslider', 'Shortcode', 'Shortcode', 'manage_options','', 'inboxlogo_shortcodes' );
}
add_action('admin_menu', 'inboxlogo_logocarousel_pages');

function inboxlogo_shortcodes(){
	?>
	<div class="row">
		<div class="col-md-12">
			<h1>ShortCode : </h1>
			<h2>[Logos_Carousel]</h2>
		</div>
	</div>
	<?php
}


function inboxlogo_logocarousel_initialize() {
		$labels_logocarouselslider = array(
			'name'               => _x('Logo slider', 'Logo slider', 'logocarousel_slider'),
			'singular_name'      => _x('slider Item', 'slider Items', 'logocarousel_slider'),
			'menu_name'          => __('Logo slider', 'logocarousel_slider'),
			'all_items'          => __('All Logo', 'logocarousel_slider'),
			'view_item'          => __('View Item', 'logocarousel_slider'),
			'add_new_item'       => __('Add New Logo', 'logocarousel_slider'),
			'add_new'            => __('Add New Logo', 'logocarousel_slider'),
			'edit_item'          => __('Edit Carousel Item', 'logocarousel_slider'),
			'update_item'        => __('Update Carousel Item', 'logocarousel_slider'),
			'search_items'       => __('Search Carousel', 'logocarousel_slider'),
			'not_found'          => __('No Carousel items found', 'logocarousel_slider'),
			'not_found_in_trash' => __('No Carousel items found in trash', 'logocarousel_slider')
		);

		$args_logocrowsalslider   = array(
			'label'               => __('Logo Carousel slider', 'logocarousel_slider'),
			'description'         => __('Logo Carousel slider Post Type', 'logocarousel_slider'),
			'labels'              => $labels_logocarouselslider,
			'supports'            => array( 'title','thumbnail','comments' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'menu_icon'   => 'dashicons-slides',
			'capability_type'     => 'post',
		);


		//declare custom post type logocrowsalslider
		register_post_type( 'logocrowsalslider', $args_logocrowsalslider);


		// Register Taxonomy
		$logocrowsalslider_cat_args = array(
			'hierarchical'   => true,
			'label'          => __('Categories', 'logocarousel_slider'),
			'show_ui'        => true,
			'query_var'      => true,
			'show_admin_column' => true,
			'singular_label' => __('Category', 'logocarousel_slider'),
		);
		register_taxonomy('logoslidercat', array('logocrowsalslider'), $logocrowsalslider_cat_args);
	}
add_action( 'init', 'inboxlogo_logocarousel_initialize' );


function inboxlogo_logo_crarousel_display(){ 

	$args = array('post_type' => 'logocrowsalslider','posts_per_page' => -1 ,'orderby'=>'title','order'=>'DESC');
	$loop = new WP_Query( $args );
?>

<div class="container">
	<?php if ( $loop->have_posts() ) :?>
	<div class="row">
		<div class="customer-logos ">
		<?php while ( $loop->have_posts() ) : $loop->the_post();?>
		  <div class="slide"><img src="<?php echo get_the_post_thumbnail_url();?>"></div>
		<?php endwhile;?>
		</div>
	</div>
	<?php endif;?>
</div>
<?php
}	
add_shortcode('Logos_Carousel','inboxlogo_logo_crarousel_display');	
?>


 
