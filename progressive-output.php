<?php
/**
 * Plugin Name: Progressive Output
 * Plugin URI: https://github.com/chwnam/progressive-output
 * Description: A wordpress test plugin for progressive output
 * Version: 1.0
 * Author: Changwoo Nam
 * Author URI: cs.chwnam@gmail.com
 */

add_action( 'admin_menu', 'po_menu' );

function po_menu() {
	add_menu_page(
		'Progressive Output',
		'PO',
		'manage_options',
		'progressive-output',
		'po_output_progressive_output'
	);
}

function po_output_progressive_output() { ?>
	<div class="wrap">
		<h1>Progressive Output Test</h1>
		<p>
			<button type="button" class="button button-primary" id="progressive-output-test">TEST</button>
		</p>
		<hr>
		<textarea id="progressive-output-output-area" rows="3" cols="80" readonly="readonly"></textarea>
	</div>
<?php }


add_action( 'admin_enqueue_scripts', 'po_scripts' );

function po_scripts( $hook ) {
	if ( $hook === 'toplevel_page_progressive-output' ) {
		wp_enqueue_script( 'progressive-output', plugins_url( 'progressive-output.js', __FILE__ ), array( 'jquery' ) );
	}
}


add_action( 'wp_ajax_request-progressive-output', 'po_response_progressive_output' );

function po_response_progressive_output() {
	set_time_limit( 0 );
	ob_implicit_flush( true );
	ob_end_flush();

	$count = 30;
	while ( $count -- ) {
		echo wp_json_encode(
			array(
				'success' => true,
				'data'    => array(
					'count'   => $count,
					'message' => 'The time limit',
				),
			)
		);
		sleep( 1 );
	}

	die();
}
