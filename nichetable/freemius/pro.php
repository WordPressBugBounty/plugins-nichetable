<?php
/**
 * NicheTable Pro only
 * @package NicheTable
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

  if ( ! function_exists( 'activation_freemius_premium' ) ) {
    add_action( 'enqueue_block_editor_assets', 'activation_freemius_premium' );
    function activation_freemius_premium() {
      // Register block editor styles for backend.
      wp_enqueue_style(
        'nichetablewpwp-freemius-secr-premium', // Handle.
        plugins_url( 'freemius/assets/css/freemius.pro.build.premium.css', dirname( __FILE__ ) ), // Block editor CSS.
        array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
        null 
      );
      
    }
} 



