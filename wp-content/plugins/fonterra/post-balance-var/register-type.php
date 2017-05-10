<?php

add_action('init', 'register_post_balance_var');
function register_post_balance_var()
{
	register_post_type('balance_var',
		array(
			'labels' => array(
				'name' => __('Balance variables'),
				'singular_name' => __('Balance variable')
				),
			'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
			'publicly_queriable' => true,  // you should be able to query it
			'show_ui' => true,  // you should be able to edit it in wp-admin
			'exclude_from_search' => true,  // you should exclude it from search results
			'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
			'has_archive' => false,  // it shouldn't have archive page
			'rewrite' => false,  // it shouldn't have rewrite rules
			/*'public' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
				),
			'taxonomies'  => array('level')*/
			)
		);
}

/*-------------------------------------------------------------------------------
	Custom Columns
-------------------------------------------------------------------------------*/
/*
function phase_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
		'title' 	=> 'Tekst',
		'level' 	=> 'Level',
		'phase' 	=> 'Fase',
	);
	return $columns;
}
add_filter("manage_edit-phase_columns", "phase_columns");

function phase_custom_columns($column)
{
	global $post;
	if($column == 'level')
	{
		$level = get_field('level', $post->ID);
		echo $level->post_title;
	}
	elseif($column == 'phase')
	{
		echo get_field('phase', $post->ID);
	}
}
add_action("manage_phase_posts_custom_column", "phase_custom_columns");
*/
/*-------------------------------------------------------------------------------
	Sortable Columns
-------------------------------------------------------------------------------*/
/*
function phase_column_register_sortable( $columns )
{
	$columns['level'] = 'level';
	$columns['phase'] = 'phase';
	return $columns;
}
add_filter("manage_edit-phase_sortable_columns", "phase_column_register_sortable" );
*/