<?php



/*

Plugin Name: Light Particles

Plugin URI: 

Version: 1.03

Description: Display beautiful particles on your website :)

Author: Manu225

Author URI: https://www.info-d-74.com/en/shop/

Network: false

Text Domain: light-particles

Domain Path:

*/



register_activation_hook( __FILE__, 'wp_particles_install' );

register_uninstall_hook(__FILE__, 'wp_particles_desinstall');



function wp_particles_install() {



	//ajoute les options de config

	add_option( 'wp_particles_quantity', 50 );

	add_option( 'wp_particles_speed', 2 );

	add_option( 'wp_particles_opacity', 1 );

	add_option( 'wp_particles_display_on', '' );



}



function wp_particles_desinstall() {



	//suppression des options

	delete_option( 'wp_particles_quantity' );

	delete_option( 'wp_particles_speed' );

	delete_option( 'wp_particles_opacity' );

	delete_option( 'wp_particles_display_on' );



}



add_action( 'admin_menu', 'register_wp_particles_menu' );

function register_wp_particles_menu() {

	add_submenu_page( 'options-general.php', 'Light Particles settings', 'Light Particles settings', 'edit_pages', 'wp_particles_settings', 'wp_particles_settings');

}



add_action('admin_print_styles', 'admin_wp_particles_css' );

function admin_wp_particles_css() {

    wp_enqueue_style( 'WPPCSS', plugins_url('css/admin.css', __FILE__) );

}



add_action( 'admin_enqueue_scripts', 'admin_wp_particles_script' );

function admin_wp_particles_script() {

    //wp_enqueue_script( 'wp-media');

     wp_enqueue_media();

}



function wp_particles_settings() {

	//formulaire soumis ?

	if(sizeof($_POST))

	{

		check_admin_referer( 'wpp_settings' );



		if(isset($_POST['quantity_random']))

			$quantity = 0;

		else

		{

			$quantity = (int)$_POST['quantity'];

			if($quantity < 1)

				$quantity = 1;

			else if($quantity > 100)

				$quantity = 100;

		}



		if(isset($_POST['speed_random']))

			$speed = 0;

		else

		{

			$speed = (int)$_POST['speed'];

			if($speed < 1)

				$speed = 1;

			else if($speed > 10)

				$speed = 10;

		}



		$opacity = (float)$_POST['opacity'] ;



		$display_on = (int)$_POST['display_on'];

		

		update_option('wp_particles_quantity', $quantity);

		update_option('wp_particles_speed', $speed);

		update_option('wp_particles_opacity', $opacity);

		update_option('wp_particles_display_on', $display_on);



	}

	else

	{

		$quantity = get_option('wp_particles_quantity');

		$speed = get_option('wp_particles_speed');

		$opacity = get_option('wp_particles_opacity');

		$display_on = get_option('wp_particles_display_on');

	}



	include(plugin_dir_path( __FILE__ ) . 'views/settings.php');

}



add_action( 'wp_head', 'head_wp_particles' );

function head_wp_particles()

{

	$display_on = get_option('wp_particles_display_on');

	$current_page = get_queried_object();



	if($display_on == 0 || $display_on == $current_page->ID)

	{

		wp_enqueue_style( 'WPPFRONTCSS', plugins_url('css/front.css', __FILE__) );

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'jquery-ui-core' );

		wp_enqueue_script( 'jquery-effects-core');



		// Register the script

		wp_register_script( 'WPPFRONTJS', plugins_url( 'js/front.js', __FILE__ ) );



		// Localize the script with new data

		$settings = array(

			'quantity' => (int)get_option('wp_particles_quantity'),

			'speed' => (int)get_option('wp_particles_speed'),

			'opacity' => get_option('wp_particles_opacity'),

		);

		wp_localize_script( 'WPPFRONTJS', 'settings_wpp', $settings );

		wp_enqueue_script( 'WPPFRONTJS');

	}

}