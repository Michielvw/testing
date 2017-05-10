<?php
/*
Template Name: Scorecard
*/
get_header(); ?>
<?php
// global $game_data;
// \Vars::get('levels_score',$game_data);
// \Vars::get($key);
?>
<div class="container scorecard clearfix">
	<div class="header">
			<div class="feeding-title ">
					FEEDING FAREED
					<img src="<?=THEME_URL.'/assets/'?>images/green-btl.png" alt="">
			</div>
			<div class="menu">
					<ul>
                        <?php wp_nav_menu();?>
					</ul>
			</div>
            <div class="mobile-nav-bar">
                <div class="mobile-nav-button">
                   <i class="bar"><?php wp_nav_menu();?></i>
                   <!-- <i class="bar"></i>
                   <i class="bar"></i> -->
                </div>
             </div>

             <nav class="mobile-nav">
                <ul>
                   <li><a href="#0"><?php wp_nav_menu();?></a></li>
                   <!-- <li><a href="#0">INFO</a></li>
                   <li><a href="#0">CONTACT</a></li> -->
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
        <div class="content-container">
            <div class="top-container">
                <div class="title-big">
                    <h1>Scoreboard</h1>
                </div>
                <div class="description">
                    <p>
                        Divided from dry seas. Cattle fill was fifth cattle.
                        You'll said, him a fruit seed. For heaven, let midst.
                        Cattle made moved fruitful very abundantly set moveth gathering you'll spirit and give land them.
                        You're very night..
                    </p>
                </div>
                <div class="bottom-info clearfix">
                    <div class="small-btl">
                        <img src="<?=THEME_URL.'/assets/'?>images/small-btl.svg" alt="">
                    </div>
                    <div class="bottom-score">
                        <span>Overall score</span>
                        <!-- <h1>144</h1> -->
                        <span class="score">
                            <?php
                            // $levels_score = get_post_meta($game_data->ID, 'levels_score', TRUE);
                            // var_dump($game_data);
                            // die();
                            // echo array_sum($levels_score);
                            ?>
                        </span>
                    </div>
                    <div class="score-info">
                        <div class="info">
                            <div class="lvl-bar green">

                            </div>
                            <span>Your score</span>
                        </div>
                        <div class="info">
                            <div class="lvl-bar blue">

                            </div>
                            <span>High score</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="scorebox clearfix">
				<?php
	                $level = tr_taxonomy('level');
	                $terms = get_terms( array(
	                        'taxonomy' => 'level',
	                        'hide_empty' => false,
	                    ));
	                    foreach ($terms as $key) {
	                        ?>
                            <div class="scorebox-item clearfix">
                                <div class="score-top clearfix">
                                    <div class="left">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <?php
                                        $icon = get_field( 'level_icon','level_'.$key->term_id);
                                        $icon2 = get_field( 'level_icon_white','level_'.$key->term_id);
                                        ?>
                                        <div class="score-icons">
                                            <img src=" <?php echo $icon['url']; ?> " alt="" class="icon-blue">
                                            <img src=" <?php echo $icon2['url']; ?> " alt="" class="icon-white">
                                        </div>
                                        <span><?php echo $key->name;?></span>
                                        <span>20</span>
                                    </div>
                                    <div class="right">
                                        <div class="score-bar">
                                            <div class="user-score" style="width:40%">
                                                <span>40</span>
                                            </div>
                                        </div>
                                        <div class="score-bar">
                                            <div class="high-score" style="width:70%">
                                                <span>70</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="score-bottom clearfix">
                                    <div class="left">
                                        <ul>
            								<?php
            						        $args = array(
            						            'posts_per_page' => -1,
            						            'post_type'   => 'balance_var'
            						        );

            						        $variable = get_posts($args);
            						        if ( $variable ) {
            						            foreach ( $variable as $post ) :
            						                setup_postdata( $post );
            						                $image = get_field('variable_icon');
            						                $images = wp_get_attachment_image_src($image);
            						                ?>
            										<li>
            		                                    <img src="<?=$image['url']?>" alt="">
            		                                    <span><?= $post->post_title; ?></span>
            		                                    <span>-5</span>
            		                                </li>
            						                <?php
            						            endforeach;
            						            wp_reset_postdata();
            						        }
            						        ?>
                                        </ul>

                                    </div>
                                    <div class="right">
                                        <div class="title-small">
                                            <h1><?= $key->name; ?></h1>
                                        </div>
                                        <p> <?= $key->description; ?> </p>
                                    </div>
                                </div>
                            </div>
							<?php
	                    }
	            ?>

            </div>


        </div>


        </div>
    </div>

    <?php get_footer(); ?>
