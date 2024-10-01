<?php

/**
 * Plugin Name:NicheTable
 * Plugin URI: http://tauhidpro.com/nichetablewpwp
 * Author: Tauhidpro
 * Author URI: http://tauhidpro.com
 * Version: 2.8.4
 * License: GPL2+
 * Description: Easily create product Comparison Tables that feature all kinds of data. This great plugin will allow you to show your viewers the similarities and differences between two or more products.
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt 
 * Text Domain: nichetablewpwp
 *
 * @package NicheTable
 */
// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Define
define( 'NICHETABLE_VER', '2.1.4' );
// Freemius SDK: Auto deactivate the free version when activating the paid one.

if ( function_exists( 'nictable' ) ) {
    nictable()->set_basename( false, __FILE__ );
    return;
}

/** =============== Block Category ================ */
add_filter(
    'block_categories_all',
    function ( $categories, $post ) {
    return array_merge( $categories, array( array(
        'slug'  => 'nichetablewpwp',
        'title' => 'NicheTable',
        'icon'  => 'excerpt-view',
    ) ) );
},
    10,
    2
);
/*=============== Require File===============================*/

if ( !function_exists( 'nichetablewpwp_blocks_loader' ) ) {
    add_action( 'plugins_loaded', 'nichetablewpwp_blocks_loader' );
    function nichetablewpwp_blocks_loader()
    {
        /** Block Initializer: Load the blocks functionality */
        require_once plugin_dir_path( __FILE__ ) . 'dist/init.php';
        /** *Registry Layout Component */
        
        if ( PHP_VERSION_ID >= 50600 ) {
            require_once plugin_dir_path( __FILE__ ) . 'includes/table-importer/layout-functions.php';
            require_once plugin_dir_path( __FILE__ ) . 'includes/table-importer/class-component-registry.php';
            require_once plugin_dir_path( __FILE__ ) . 'includes/table-importer/register-layout-components.php';
            require_once plugin_dir_path( __FILE__ ) . 'includes/table-importer/layout-endpoints.php';
            require_once plugin_dir_path( __FILE__ ) . 'includes/notes.php';
        }
    
    }

}

/** === Redirect to the Nichetable Getting Started page on single plugin activation. ===*/
register_activation_hook( __FILE__, function () {
    add_option( 'nichetablewpwp_redirect', true );
} );
add_action( 'admin_init', function () {
    
    if ( get_option( 'nichetablewpwp_redirect', false ) ) {
        delete_option( 'nichetablewpwp_redirect' );
        exit( wp_redirect( "admin.php?page=nichetablewpwp" ) );
    }

} );
/** ====== nichetablewpwp_add_action_links plugins activ/dicactivation area =======*/

if ( !function_exists( 'nichetablewpwp_add_action_links' ) ) {
    add_filter(
        'plugin_action_links',
        'nichetablewpwp_add_action_links',
        10,
        5
    );
    function nichetablewpwp_add_action_links( $actions, $plugin_file )
    {
        $action_links = array(
            'demos' => array(
            'label' => __( 'Demos', 'my_domain' ),
            'url'   => 'http://tauhidpro.com/nichetable/#wp',
        ),
        );
        return plugin_action_links(
            $actions,
            $plugin_file,
            $action_links,
            'before'
        );
    }

}

if ( !function_exists( 'plugin_action_links' ) ) {
    /** plugin_action_links */
    function plugin_action_links(
        $actions,
        $plugin_file,
        $action_links = array(),
        $position = 'after'
    )
    {
        static  $plugin ;
        if ( !isset( $plugin ) ) {
            $plugin = plugin_basename( __FILE__ );
        }
        
        if ( $plugin == $plugin_file && !empty($action_links) ) {
            foreach ( $action_links as $key => $value ) {
                $link = array(
                    $key => '<a href="' . $value['url'] . '">' . $value['label'] . '</a>',
                );
                
                if ( $position == 'after' ) {
                    $actions = array_merge( $actions, $link );
                } else {
                    $actions = array_merge( $link, $actions );
                }
            
            }
            //foreach
        }
        
        // if
        return $actions;
    }

}
/* ==================================================== SDK */

if ( !function_exists( 'nictable' ) ) {
    // Create a helper function for easy SDK access.
    function nictable()
    {
        global  $nictable ;
        
        if ( !isset( $nictable ) ) {
            // Activate multisite network integration.
            if ( !defined( 'WP_FS__PRODUCT_4575_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_4575_MULTISITE', true );
            }
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $nictable = fs_dynamic_init( array(
                'id'              => '4575',
                'slug'            => 'nichetable',
                'type'            => 'plugin',
                'public_key'      => 'pk_29600fcca73b80521b436db0f97ed',
                'is_premium'      => false,
                'has_addons'      => false,
                'has_paid_plans'      => true,
                'menu'            => array(
                'slug'       => 'nichetablewpwp',
                'first-path' => 'admin.php?page=nichetablewpwp',
            ),
                'is_live'         => true,
            ) );
        }
        
        return $nictable;
    }
    
    // Init Freemius.
    nictable();
    // Signal that SDK was initiated.
    do_action( 'nictable_loaded' );
}

/* /==================================================== SDK */
if ( nictable()->can_use_premium_code() ) {
    // This IF will be executed only if the user in a trial mode or have a valid license.
    if ( file_exists( plugin_dir_path( __FILE__ ) . 'pro__premium_only/pro.php' ) ) {
        require_once plugin_dir_path( __FILE__ ) . 'pro__premium_only/pro.php';
    }
}
if ( nictable()->is_free_plan() ) {
    
    if ( !function_exists( 'activation_plugins_pro' ) ) {
        add_action( 'enqueue_block_editor_assets', 'activation_plugins_pro' );
        function activation_plugins_pro()
        {
            // Register block editor styles for backend.
            wp_enqueue_style(
                'nichetablewpwp-cgb-secr',
                plugins_url( '/dist/blocks.pro.build.css', __FILE__ ),
                [],
                filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.pro.build.css' )
            );
        }
    
    }

}
if ( nictable()->is_trial() ) {
    if ( nictable()->is_free_plan() ) {
        
        if ( !function_exists( 'nichetable_is_trial' ) ) {
            add_action( 'enqueue_block_editor_assets', 'nichetable_is_trial' );
            function nichetable_is_trial()
            {
                // Register block editor styles for backend.
                wp_enqueue_style(
                    'nichetable-is-trial',
                    plugins_url( '/dist/nichetable_is_trial.css', __FILE__ ),
                    [],
                    filemtime( plugin_dir_path( __FILE__ ) . 'dist/nichetable_is_trial.css' )
                );
            }
        
        }
    
    }
}
/*===================== Wellcome Page and admin menu ==========================*/

if ( !function_exists( 'nichetablewpwp_admin_menu' ) ) {
    function nichetablewpwp_admin_menu()
    {
        add_menu_page(
            __( 'nichetablewpwp', 'nichetablewpwp' ),
            __( 'NicheTable', 'nichetablewpwp' ),
            'manage_options',
            'nichetablewpwp',
            'nichetablewpwp_settings_page_render',
            'dashicons-excerpt-view'
        );
    }
    
    add_action( 'admin_menu', 'nichetablewpwp_admin_menu' );
}


if ( nictable()->can_use_premium_code() ) {
    // ... premium only logic ...
    
    if ( file_exists( plugin_dir_path( __FILE__ ) . 'pro__premium_only/wellcome.php' ) ) {
        require_once plugin_dir_path( __FILE__ ) . 'pro__premium_only/wellcome.php';
    } else {
        require_once plugin_dir_path( __FILE__ ) . 'dist/wellcome.php';
    }

} else {
    require_once plugin_dir_path( __FILE__ ) . 'dist/wellcome.php';
}