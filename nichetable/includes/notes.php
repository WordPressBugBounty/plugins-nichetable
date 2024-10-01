<?php
/**
 * Compatibility related functionality.
 */

if ( PHP_VERSION_ID < 50600 ) {
	add_action( 'enqueue_block_editor_assets', 'nichetablewpwp_blocks_unregister_incompatible_blocks' );
}
/**
 * Unregisters certain blocks on sites
 * running PHP < 5.6.
 */
function nichetablewpwp_blocks_unregister_incompatible_blocks() {
	?>
	<script>
		window.addEventListener( 'DOMContentLoaded', function() {
			wp.domReady( function() {
				wp.blocks.unregisterBlockType( 'nichetablewpwp/table-importer' );
			} );
		} );
	</script>
	<?php
}
