<?php

// add_action('init', 'game_init');
function get_game_data()
{
	$args = array(
		'post_type'		=> 'game_progress',
		'author'		=> get_current_user_id(),
		'post_status'	=> 'draft'
		/*'meta_query' => array(
			array(
				'key'     => 'progress',
				'value'   => 'in-progress',
			),
		),*/
	);

	$games = get_posts($args);

	if(empty($games[0]))
	{
		$terms = get_terms(array(
		    'taxonomy' => 'level',
		    'hide_empty' => false,
		    'meta_key' => 'level',
		    'meta_value' => '1'
		));

		$postarr = array(
			'post_title'	=> time(),
			'post_type'		=> 'game_progress',
			'post_status'	=> 'draft',
			'meta_input'	=> array(
				'current_level'	=> 1,
				'current_level_id'	=> $terms[0]->term_id,
				'current_question_id'	=> 0,
				'answers'	=> array(),		//$answers[level_id][question_id] = array(index => '', )
				'overall_score'	=> 0,
				'levels_score'	=> array(),
				'variables_score'	=> array()
				)
			);
		$insert_id = wp_insert_post($postarr);

		return get_post($insert_id);
	}
	else
	{
		return $games[0];
	}


	/*$query = new WP_Query( $args );

	if ($query->have_posts())
	{
		while ($query->have_posts())
		{
			$query->the_post();
		}
	}*/
}


add_action('init', 'save_game_answer');
function save_game_answer()
{
	if(isset($_POST['selector']))
	{
		// get the current game data
		$game_data = get_game_data();
		\Vars::set('ID',$game_data);
		// get game answers list
		$answers = get_post_meta($game_data->ID, 'answers', TRUE);
		if( ! isset($answers[$game_data->current_level_id][$_POST['question_id']]))
		{
			// get current question data
			$question_data = get_post($_POST['question_id']);
			// get the answers list
			$question_answers = get_field('answer', $question_data->ID);

			// check the question type
			if($question_data->post_type == 'factualquestion')
			{
				// if answer is correct
				if($question_answers[$_POST['selector']]['is_answer_correct'])
				{
					/*// update overall_score
					$overall_score = get_post_meta($game_data->ID, 'overall_score', TRUE);
					$overall_score = (int)$overall_score + 2;
					update_post_meta($game_data->ID, 'overall_score', $overall_score);*/

					// update the currentlevel points
					$current_level_id = get_post_meta($game_data->ID, 'current_level_id', TRUE);
					$levels_score = get_post_meta($game_data->ID, 'levels_score', TRUE);
					$levels_score[$current_level_id] += 2;
					update_post_meta($game_data->ID, 'levels_score', $levels_score);
				}

				$answer_data = array(
					'index'			=> $_POST['selector'],
					'type'			=> $question_data->post_type,
					'is_correct'	=> ($question_answers[$_POST['selector']]['is_answer_correct']) ? TRUE : FALSE
				);
			}
			else
			{
				$choosen_answer = $question_answers[$_POST['selector']];

				$answer_data = $choosen_answer;
				$answer_data['index'] = $_POST['selector'];
				$answer_data['type'] = $question_data->post_type;

				// update the variable points
				$variables_score = get_post_meta($game_data->ID, 'variables_score', TRUE);
				foreach($choosen_answer['variables'] as $val)
				{
					$variables_score[$val['variable']] = (int)@$variables_score[$val['variable']] + (int)$val['variable_point'];
				}
				update_post_meta($game_data->ID, 'variables_score', $variables_score);

				// update the level points
				$levels_score = get_post_meta($game_data->ID, 'levels_score', TRUE);
				foreach($choosen_answer['consequence_points'] as $val)
				{
					$levels_score[$val['level_name']] = (int)@$levels_score[$val['level_name']] + (int)$val['level_point'];
				}
				update_post_meta($game_data->ID, 'levels_score', $levels_score);
			}

			// update choosen answer
			$answers[$game_data->current_level_id][$_POST['question_id']] = $answer_data;
			update_post_meta($game_data->ID, 'answers', $answers);
		}
	}
}
