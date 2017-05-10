<?php
/*
Template Name: Level intro
*/

$game_data = get_game_data();
/*
$current_level = ( ! empty($game_data->current_level)) ? $game_data->current_level : 1;

$terms = get_terms(array(
    'taxonomy' => 'level',
    'hide_empty' => false,
    'meta_key' => 'level',
    'meta_value' => $game_data->current_level
));
*/

get_header();
?>

<div class="container level-intro clearfix">
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
    <div class="full-side">
        <div class="decoration">
            <div class="decoration1">
                <img src="<?=THEME_URL.'/assets/'?>images/decoration1.svg" alt="">
            </div>
            <div class="decoration2">
                <img src="<?=THEME_URL.'/assets/'?>images/decoration2.svg" alt="">
            </div>
        </div>


        <div class="bottle-container"></div>
        <div class="content-container">
        <?php $term = get_term($game_data->current_level_id); ?>
            <div class="title-big">
                <h1><?=$term->name?></h1>
            </div>
            <div class="description">
                <p><?=$term->description?></p>
            </div>
            <?php /*
                $start_game = get_field('intro');
                if( $start_game ):
            	// override $post
            	$post = $start_game;
            	setup_postdata( $post );
        	*/ ?>
            <a href= "<?=site_url('question-intro')?>">
                <div class="btn">
                     Play level!
                </div>
            </a>
            <?php // wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>
