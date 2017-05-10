<?php
/*
Template Name: Welcome back
*/

$game_data = get_game_data();

$order = count(@$game_data->answers[$game_data->current_level_id]);
if($order < 1) $order = 1;

$args = array(
    'post_type'  => 'factualquestion',
            // 'meta_key' => 'level_id',
            // 'meta_value' => $game_data->current_level_id,
    'meta_query' => array(
        array(
            'key'     => 'level_id',
            'value'   => $game_data->current_level_id
            ),
        array(
            'key'     => 'order',
            'value'   => $order,
            ),
        ),
    );
$questions = get_posts( $args );

$question_data = $questions[0];

get_header();
?>

<div class="container welcome-back clearfix">
	<div class="header">
			<div class="feeding-title ">
					FEEDING FAREED
					<img src="<?=THEME_URL.'/assets/'?>images/green-btl.png" alt="">
			</div>
			<div class="menu">
					<ul>
							<a href="#"><li>view scorecard</li></a>
							<a href="#"><li>info</li></a>
							<a href="#"><li>contact</li></a>
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
                </ul>
             </nav>
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
        <?php if($question_data): ?>

            <div class="scrollable">
               <div class="title-big">
         				<h1> <?=apply_filters('the_title', $question_data->post_title)?> </h1>
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


        </div>
    </div>

</div>

<?php get_footer(); ?>
