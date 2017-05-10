<?php

function tax_level_init() {
	// create a new taxonomy
	register_taxonomy(
		'level',
		'post'/*,
		array(
			'label' => __( 'People' ),
			'rewrite' => array( 'slug' => 'person' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)*/
	);
}
add_action( 'init', 'tax_level_init' );
