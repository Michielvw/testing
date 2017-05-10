<?php

/*
$args = array(
	'post_type'		=> 'game_progress',
	'author'		=> get_current_user_id(),
	'meta_query' => array(
		array(
			'key'     => 'progress',
			'value'   => 'in-progress',
		),
	),
);

$query = new WP_Query( $args );

if ($query->have_posts())
{
	while ($query->have_posts())
	{
		$query->the_post();
	}
}
*/

$game_data = get_game_data();

get_header(); ?>

<div class="container clearfix">
	<div class="header">
			<div class="feeding-title ">
					FEEDING FAREED
					<img src="<?=THEME_URL.'/assets/'?>images/green-btl.png" alt="">
			</div>
            <?php $redirect = BASE_URL. '/login/'; ?>
			<div class="menu">
				<ul>
					<a href="#"><li>view scorecard</li></a>
					<a href="#"><li>info</li></a>
					<a href="#"><li>contact</li></a>
					<a href="<?= wp_logout_url($redirect); ?>"><li>logout</li></a>
				</ul>
			</div>

            <div class="mobile-nav-bar">
                <div class="mobile-nav-button">
                   <i class="bar"></i>
                   <i class="bar"></i>
                   <i class="bar"></i>
                </div>
             </div>

             <nav class="mobile-nav">
                <ul>
                   <li><a href="#0">VIEW SCOREBOARD</a></li>
                   <li><a href="#0">INFO</a></li>
                   <li><a href="#0">CONTACT</a></li>
				   <li><a href="<?= wp_logout_url($redirect); ?>">logout</a></li>
                </ul>
             </nav>
	</div>
    <div class="mobile-score">
        <div class="mobile-score-item item-1 active">
            <span>Level 4/8</span>
            <span>Dilemma 3</span>
        </div>
        <div class="mobile-score-item item-2">
            <span>Level Score</span>
            <span>23</span>
        </div>
        <div class="mobile-score-item item-3">
            <span>Leaderboard</span>
            <span>104</span>
        </div>
    </div>
    <div class="left-side">
        <div class="decoration">
            <div class="decoration1">
                <img src="<?=THEME_URL.'/assets/'?>images/decoration1.svg" alt="">
            </div>
            <div class="decoration2">
                <img src="<?=THEME_URL.'/assets/'?>images/decoration2.svg" alt="">
            </div>
        </div>
        <?php get_sidebar('bottle'); ?>
        <div class="content-container">


		<?php
		/*
		if($_GET['fase'] === '0')
		{
			// insert new post, to track the history
			$result_id = wp_insert_post(array(
				'post_type' => 'result',
				));
		}
		*/
		// $args = array(
		// 	'post_type'  => 'phase_transition',
		// 	'meta_query' => array(
		// 		array(
		// 			'key'     => 'level',
		// 			'value'   => $_GET['level-id'],
		// 		),
		// 		array(
		// 			'key'     => 'phase',
		// 			'value'   => $_GET['fase'],
		// 		),
		// 	),
		// );
		// $query = new WP_Query( $args );

		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="transition-text" class="entrycontent">
				<h3 class="research-title"></h3>
			</div>
			<!-- <div class="aligncenter">
				<a href="<?php echo ($_GET['fase'] == 5) ? add_query_arg(array('level-id' => $_GET['level-id'], 'fase' => 1), site_url('phase-score')) : add_query_arg(array('level-id' => $_GET['level-id'], 'fase' => $_GET['fase']), site_url('phase')); ?>" class="research-done btn regular-btn secondary-btn" data-price="4"><?php the_field('button_name');
				?></a>
			</div> -->


            <div class="level-status">
                <p><span class="level-number"><?php the_title(); ?></span></p>
                <div class="level-separator"></div>
            </div>
            <div class="scrollable">

	            <div class="title-medium">
	                <!-- <h1>Dilemma 3/8 : The Road</h1> -->
	            </div>

	            <div class="description">
	                <?php the_content(); ?>
	            </div>

	            <div class="question">
	                <p>How do you pack your cheese and what is the envisaged price? </p>
	            </div>

                <div class="answer">
	                <ul class="clearfix">
                        <?php
                        $i=0;
                        if( have_rows('answer') ):
                            while ( have_rows('answer') ) : the_row();
                            $rightanswer = get_sub_field('is_answer_correct'); ?>
        	                    <li>
        	                        <input type="radio" id="<?=$i?>-option" name="selector" value="<?=the_sub_field('is_answer_correct');?>">
        	                        <label for="<?=$i?>-option"><?=the_sub_field('answer_text');?></label>
									<!-- <?php echo $rightanswer; ?> -->
        	                        <div class="check"></div>

        	                    </li>
                        <?php $i++; endwhile; else : endif;?>
                    </ul>
                </div>

	        </div>


            <?php
                $nextquestion = get_field('next');
                if( $nextquestion ):
            	// override $post
            	$post = $nextquestion;
            	setup_postdata( $post );
        	?>
            <a href= "<?php the_permalink(); ?>">
                <div class="btn">
                    next dillema >
                </div>
            </a>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
		<?php endwhile; else: ?>
        <?php wp_reset_postdata(); ?>
		<?php endif; ?>

        </div>
    </div>
    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
