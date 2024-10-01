<?php
/**
 * Layout block related functions.
 */

use LayCnichetablewpwp\Layouts\Component_Registry;

/** Registers layout components with the Component Registry, for use in the Layouts block. */
function nichetablewpwp_blocks_register_layout_component( array $data ) {

	$registry = Component_Registry::instance();

	try {
		$registry::add( $data );
		return true;
	} catch ( Exceptionnichetablewpwp $Exceptionnichetablewpwp ) {
		return new WP_Error( esc_html( $Exceptionnichetablewpwp->getMessage() ) );
	}
}

/** Unregisters the specified layout component from the Component Registry */
function nichetablewpwp_blocks_unregister_layout_component( $type, $key ) {
	$registry = Component_Registry::instance();
	try {
		$registry::remove( $type, $key );
		return true;
	} catch ( Exceptionnichetablewpwp $Exceptionnichetablewpwp ) {
		return new WP_Error( esc_html( $Exceptionnichetablewpwp->getMessage() ) );
	}
}

/** Retrieves the specified layout component. */
function nichetablewpwp_blocks_get_layout_component( $type, $key ) {

	if ( empty( $type ) ) {
		return new WP_Error( esc_html__( 'You must supply a type to retrieve a layout component.', 'nichetablewpwp' ) );
	}

	if ( empty( $key ) ) {
		return new WP_Error( esc_html__( 'You must supply a key to retrieve a layout component.', 'nichetablewpwp' ) );
	}

	$type = sanitize_key( $type );

	$key = sanitize_key( $key );

	$registry = Component_Registry::instance();

	try {
		return $registry::get( $type, $key );
	} catch ( Exceptionnichetablewpwp $Exceptionnichetablewpwp ) {
		return new WP_Error( esc_html( $Exceptionnichetablewpwp->getMessage() ) );
	}
}

/** Gets the registered layouts */
function nichetablewpwp_blocks_get_layouts() {
	$registry = Component_Registry::instance();
	return $registry::layouts();
}

/** Gets the registered sections. */
function nichetablewpwp_blocks_get_sections() {
	$registry = Component_Registry::instance();
	return $registry::sections();
}
