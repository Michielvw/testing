<?php

add_action('init', 'register_post_game_progress');
function register_post_game_progress()
{
	register_post_type('game_progress',
		array(
			'labels' => array(
				'name' => __('Game progress'),
				'singular_name' => __('Game progress')
				),
			'public' => true/*,
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

function phase_column_register_sortable( $columns )
{
	$columns['level'] = 'level';
	$columns['phase'] = 'phase';
	return $columns;
}
add_filter("manage_edit-phase_sortable_columns", "phase_column_register_sortable" );
*/