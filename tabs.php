<?php
/*
Plugin Name: SIS Tabs
Plugin URI: https://wordpress.org/plugins/sis-tabs
Description: This plugin will displays collapsible content panels for presenting information in a limited amount of space.
Author: Sayful Islam
Author URI: http://sayful.net
Version: 1.2
*/
// Set up our WordPress Plugin
function sis_tabs_check_WP_ver()
{
	$options_array = array(
      	'collapsible' 	=> 'false',
        'active' 		=> '0',
        'disabled' 		=> '',
        'event' 		=> 'click',
        'heightStyle' 	=> 'content',
        'theme' 	=> 'lightness',
    );
	if ( get_option( 'sis_tabs_options' ) !== false ) {
		// The option already exists, so we just update it.
      	update_option( 'sis_tabs_options', $options_array );
   } else{
   		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
   		add_option( 'sis_tabs_options', $options_array );
   }
}
register_activation_hook( __FILE__, 'sis_tabs_check_WP_ver' );

// add the admin options page
add_action('admin_menu', 'sis_tabs_add_menu');
function sis_tabs_add_menu(){
   add_options_page( 'Tabs Setting', 'Tabs', 'manage_options', 'sis-tabs/tabs-options.php');
}

// This function registers our options to be updated.
add_action('admin_init', 'sis_tabs_register_settings');
function sis_tabs_register_settings(){
   register_setting( 'sis_tabs_options', 'sis_tabs_options');
}

/* Adding Latest jQuery from Wordpress plugin */
function sis_tabs_plugin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-effects-core');
	
	$options = get_option( 'sis_tabs_options' );
	wp_enqueue_style('sis_tabs_style',plugins_url( '/css/'.$options["theme"].'/jquery-ui-1.10.4.custom.css' , __FILE__ ));
}
add_action('init', 'sis_tabs_plugin_scripts');
/*Plugin Activation hook*/
function sis_tabs_plugin_activation(){
	$options = get_option( 'sis_tabs_options' );
	?><script type="text/javascript">
		jQuery(function() {
			jQuery( "#tabs" ).tabs({
				collapsible: <?php echo $options['collapsible']; ?>,
				active: <?php echo $options['active']; ?>,
				disabled: [<?php echo $options['disabled']; ?>],
				event: "<?php echo $options['event']; ?>",
				heightStyle: "<?php echo $options['heightStyle']; ?>",
			});
		});
	</script><?php
}
add_action( 'wp_footer', 'sis_tabs_plugin_activation' );

// Register Custom Post Type
function sis_wp_custom_post_type() {

	$labels = array(
		'name'                => _x( 'Tabs', 'Post Type General Name', 'wptabs' ),
		'singular_name'       => _x( 'Tab', 'Post Type Singular Name', 'wptabs' ),
		'menu_name'           => __( 'Tabs', 'wptabs' ),
		'parent_item_colon'   => __( 'Parent Tab:', 'wptabs' ),
		'all_items'           => __( 'All Tabs', 'wptabs' ),
		'view_item'           => __( 'View Tab', 'wptabs' ),
		'add_new_item'        => __( 'Add New Tab', 'wptabs' ),
		'add_new'             => __( 'Add New', 'wptabs' ),
		'edit_item'           => __( 'Edit Tab', 'wptabs' ),
		'update_item'         => __( 'Update Tab', 'wptabs' ),
		'search_items'        => __( 'Search Tab', 'wptabs' ),
		'not_found'           => __( 'Not found', 'wptabs' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wptabs' ),
	);
	$rewrite = array(
		'slug'                => 'tab',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'tabs', 'wptabs' ),
		'description'         => __( 'Post Type Description', 'wptabs' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-screenoptions',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'tabs', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sis_wp_custom_post_type', 0 );

/* tabs Loop */
function sis_get_tabs(){
	$tabs= '<div id="tabs"><ul>';
	$efs_query= "post_type=tabs&posts_per_page=-1";
	query_posts($efs_query);
	if (have_posts()) : while (have_posts()) : the_post(); 
		$tabs.='<li><a href="#tabs-'.get_the_ID().'">'.get_the_title().'</a></li>';		
	endwhile; endif; wp_reset_query();
	$tabs.= '</ul>';
	$efs_query= "post_type=tabs&posts_per_page=-1";
	query_posts($efs_query);
	if (have_posts()) : while (have_posts()) : the_post(); 
		$tabs.='<div id="tabs-'.get_the_ID().'">'.get_the_content().'</div>';		
	endwhile; endif; wp_reset_query();
	$tabs.= '</div>';
	return $tabs;
}

/**add the shortcode for the tabs- for use in editor**/
function sis_insert_tab($atts, $content=null){
	$tabs= sis_get_tabs();
	return $tabs;
}
add_shortcode('all-tabs', 'sis_insert_tab');