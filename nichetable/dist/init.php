<?php
/**
 * Blocks Initializer
 * @package NicheTable
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//Main Style for Front end
if ( ! function_exists( 'main_style_for_front' ) ) {
	function main_style_for_front() {
		wp_register_style(
			'nichetablewpwp-maincss-front', // Handle.
			plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
			is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
			time() // Version: File modification time.
		);
		wp_enqueue_style( 'nichetablewpwp-maincss-front' );
	}
	// Register style sheet.
	add_action( 'wp_enqueue_scripts', 'main_style_for_front' );
}


//Main Style for Editor
if ( ! function_exists( 'main_style_for_editor' ) ) {
	function main_style_for_editor() {
			wp_enqueue_style(
					'nichetablewpwp-maincss-editor',
					plugins_url( '/dist/blocks.style.build.css', dirname( __FILE__ ) ),
					[],
					filemtime( plugin_dir_path( __FILE__ ) . 'blocks.style.build.css' )	
			);
	}
	add_action( 'enqueue_block_editor_assets', 'main_style_for_editor' );
} 

/**
 * Enqueue assets for backend editor
 */
function nichetablewpwp_blocks_editor_assets() {

	// Register block editor script for backend.
	wp_enqueue_script(
		'nichetablewpwp-cgb-block-js',
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks.build.js' ),
		true
	);

	// Register block editor styles for backend.
	wp_enqueue_style(
		'nichetablewpwp-cgb-block-editor-css',
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks.editor.build.css' )
	);


	// For table demo inporter: Pass in REST URL.
	wp_localize_script(
		'nichetablewpwp-cgb-block-js',
		'nichetablewpwp_globals',
		array(
			'rest_url' => esc_url( rest_url() ),
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'nichetablewpwp_blocks_editor_assets' );

/**
 * Enqueue Gutenberg block assets for both frontend + backend.=============================================
 */

// CSS and JS For Admin
if ( ! function_exists( 'admin_style' ) ) {
function admin_style() {
	wp_enqueue_style('admin-styles',plugins_url( 'dist/getting-started.css', dirname( __FILE__ ) ) );
  }
	add_action('admin_enqueue_scripts', 'admin_style');
}



if ( nictable()->is_free_plan() ) {
	if ( ! function_exists( 'activation_freemius' ) ) {
			add_action( 'enqueue_block_editor_assets', 'activation_freemius' );
			function activation_freemius() {
        // Register block editor styles for backend.
        wp_enqueue_style(
					'nichetablewpwp-freemius-secr', // Handle.
					plugins_url( 'freemius/assets/css/freemius.pro.build.css', dirname( __FILE__ ) ), // Block editor CSS.
					array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
					null 
        );
				
			}
	} 
}