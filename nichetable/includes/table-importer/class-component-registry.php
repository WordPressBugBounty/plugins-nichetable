<?php
/** * Layout Component Registry */

namespace LayCnichetablewpwp\Layouts;

use \Exceptionnichetablewpwp;
use \InvalidArgumentExceptionnichetablewpwp;

/** Class Component_Registry */
final class Component_Registry {
	private static $supported_component_types = [ 'layout', 'section' ];
	private static $required_data_keys = [ 'type', 'key', 'name', 'content', 'category', 'keywords', 'image' ];
	private static $layouts = [];
	private static $sections = [];
	private static $instance;
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Adds a component to the registry. */
	public static function add( array $data ) {

		if ( empty( $data['type'] ) || ! in_array( $data['type'], self::$supported_component_types, true ) ) {
			throw new InvalidArgumentExceptionnichetablewpwp( esc_html__( 'You must supply a valid component type.', 'nichetablewpwp' ) );
		}

		if ( empty( $data ) ) {
			throw new InvalidArgumentExceptionnichetablewpwp( __( 'You must supply valid layout data to register a layout.', 'nichetablewpwp' ) );
		}

		foreach ( self::$required_data_keys as $required_key ) {
			if ( ! array_key_exists( $required_key, $data ) || empty( $data[ $required_key ] ) ) {
				throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a %s to register a layout.', 'nichetablewpwp' ), $required_key ) );
			}
		}

		switch ( $data['type'] ) {
			case 'layout':
				if ( ! empty( self::$layouts[ $data['key'] ] ) ) {
					throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'The %s layout is already registered.', 'nichetablewpwp' ), $data['key'] ) );
				}
				self::$layouts[ $data['key'] ] = $data;
				break;

			case 'section':
				if ( ! empty( self::$sections[ $data['key'] ] ) ) {
					throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'The %s section is already registered.', 'nichetablewpwp' ), $data['key'] ) );
				}
				self::$sections[ $data['key'] ] = $data;
				break;

			default:
				throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a valid component type in %s.', 'nichetablewpwp' ), __METHOD__ ) );
		}
	}

	/** Removes an existing component from the registry. */
	public static function remove( $type, $key ) {

		if ( empty( $type ) || ! in_array( $type, self::$supported_component_types, true ) ) {
			throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a valid component type in %s.', 'nichetablewpwp' ), __METHOD__ ) );
		}

		if ( empty( $key ) ) {
			throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a valid component key in %s.', 'nichetablewpwp' ), __METHOD__ ) );
		}

		$key = sanitize_key( $key );

		switch ( $type ) {
			case 'layout':
				if ( empty( self::$layouts[ $key ] ) ) {
					throw new Exceptionnichetablewpwp( sprintf( esc_html__( 'The %s layout is not registered.', 'nichetablewpwp' ), $key ) );
				}
				unset( self::$layouts[ $key ] );
				break;

			case 'section':
				if ( empty( self::$sections[ $key ] ) ) {
					throw new Exceptionnichetablewpwp( sprintf( esc_html__( 'The %s section is not registered.', 'nichetablewpwp' ), $key ) );
				}
				unset( self::$sections[ $key ] );
				break;
		}

	}

	/**  Gets a component from the registry. */
	public static function get( $type, $key ) {

		if ( empty( $type ) || ! in_array( $type, self::$supported_component_types, true ) ) {
			throw new Exceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a component type in %s.', 'nichetablewpwp' ), __METHOD__ ) );
		}

		switch ( $type ) {
			case 'layout':
				if ( empty( self::$layouts[ $key ] ) ) {
					throw new Exceptionnichetablewpwp( sprintf( esc_html__( 'The %s layout is not registered.', 'nichetablewpwp' ), $key ) );
				}
				return self::$layouts[ $key ];

			case 'section':
				if ( empty( self::$sections[ $key ] ) ) {
					throw new Exceptionnichetablewpwp( sprintf( esc_html__( 'The %s section is not registered.', 'nichetablewpwp' ), $key ) );
				}
				return self::$sections[ $key ];

			default:
				throw new InvalidArgumentExceptionnichetablewpwp( sprintf( esc_html__( 'You must supply a valid component type in %s.', 'nichetablewpwp' ), __METHOD__ ) );
		}
	}

	/** Registered layouts. */
	public static function layouts() {
		return self::$layouts;
	}

	/** Registered sections. */
	public static function sections() {
		return self::$sections;
	}
}
