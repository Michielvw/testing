<?php
/*
Template Name: Question
*/
/*
$args = array(
    'post_type'     => 'game_progress',
    'author'        => get_current_user_id(),
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

$current_level_answers = @$game_data->answers[$game_data->current_level_id];

$answers_num = count($current_level_answers);

// if already answered 8 times, advanced to the next level
if($answers_num >= 8)
{
    $current_level = get_post_meta($game_data->ID, 'current_level', TRUE);
    $terms = get_terms(array(
        'taxonomy' => 'level',
        'hide_empty' => false,
        'meta_key' => 'level',
        'meta_value' => $current_level + 1
    ));

    // update the level and level id
    update_post_meta($game_data->ID, 'current_level', $current_level + 1);
    update_post_meta($game_data->ID, 'current_level_id', $terms[0]->term_id);

    wp_redirect(site_url('level-intro'));
    exit;
}

$args = array(
    'post_type'  => array('factualquestion','dilemmaquestion'),
            // 'meta_key' => 'level_id',
            // 'meta_value' => $game_data->current_level_id,
    'meta_query' => array(
        array(
            'key'     => 'level_id',
            'value'   => get_post_meta($game_data->ID, 'current_level_id', TRUE),
            ),
        array(
            'key'     => 'order',
            'value'   => $answers_num + 1,
            ),
        ),
    );

// exclude answered questions
if( ! empty($current_level_answers))
{
    $args['post__not_in'] = array_keys($current_level_answers);
}

$questions = get_posts( $args );
$question_data = @$questions[0];

// update choosen question
update_post_meta($game_data->ID, 'current_question_id', @$question_data->ID);

get_header(); ?>

<div class="container clearfix question-page">
    <div class="header">
            <div class="feeding-title ">
                    FEEDING FAREED
                    <img src="<?=THEME_URL.'/assets/'?>images/green-btl.png" alt="">
            </div>
            <?php $redirect = BASE_URL. '/login/'; ?>
            <div class="menu">
                <ul>
                    <?php wp_nav_menu();	?>
                    <!-- <a href="#"><li>view scorecard</li></a>
                    <a href="#"><li>info</li></a>
                    <a href="#"><li>contact</li></a>
                    <a href="<?= wp_logout_url($redirect); ?>"><li>logout</li></a> -->
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

        <form method="post" action="<?=site_url('question-result')?>">

        <?php if ($question_data): ?>

            <div id="transition-text" class="entrycontent">
                <h3 class="research-title"></h3>
            </div>
            <!-- <div class="aligncenter">
                <a href="<?php echo ($_GET['fase'] == 5) ? add_query_arg(array('level-id' => $_GET['level-id'], 'fase' => 1), site_url('phase-score')) : add_query_arg(array('level-id' => $_GET['level-id'], 'fase' => $_GET['fase']), site_url('phase')); ?>" class="research-done btn regular-btn secondary-btn" data-price="4"><?php the_field('button_name');
                ?></a>
            </div> -->

            <input type="hidden" name="question_id" value="<?=$question_data->ID?>" class="btn" />

            <div class="level-status">
                <p><span class="level-number"><?=apply_filters('the_title', $question_data->post_title)?></span></p>
                <div class="level-separator"></div>
            </div>
            <div class="scrollable">

                <div class="title-medium">
                    <h1><?=apply_filters('the_title', $question_data->post_title)?></h1>
                </div>

                <div class="description">
                    <?=apply_filters('the_content', $question_data->post_content)?>
                </div>

            </div>

            <a href= "<?=site_url('question')?>">
                <div class="btn">
                    Continue game
                </div>
            </a>

        <?php endif; ?>

        </form>

        </div>
    </div>
    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
