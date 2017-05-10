<?php
global $game_data;
?>
<div class="right-side">
    <div class="feeding-bar">
        <?php
        $scores = get_post_meta($game_data->ID, 'variables_score', TRUE);
        $args = array(
            'posts_per_page' => -1,
            'post_type'   => 'balance_var'
        );

        $variable = get_posts($args);
        if ( $variable ) {
            foreach ( $variable as $post ) :
                // setup_postdata( $post );
                $icon = get_field('variable_icon');
                $variable_score = @$scores[$post->ID];
                ?>

                <div class="feeding-item">
                    <div class="feeding-icon">
                        <div class="icon">
                            <img src="<?=$icon['url']?>" alt="">
                            <div class="water <?php if($variable_score < 0) echo 'water-red'; ?> animated fadeInUp" style="top: calc(100% - <?php echo abs($variable_score) / 5 * 100; ?>% - 8px)"></div>
                        </div>
                    </div>
                    <p><?= $post->post_title; ?> <span><?=(int)$variable_score?></span></p>
                </div>
                <?php
            endforeach;
            // wp_reset_postdata();
        }
        ?>
        <?php /* <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/time.png" alt="">
                    <div class="water animated fadeInUp" style="top: calc(100% - 60% - 8px)">
                    </div>
                </div>
            </div>
            <p>Time <span>10</span></p>
        </div> -->
        <!-- <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/margin.png" alt="">
                    <div class="water water-red animated fadeInUp" style="top: calc(100% - 30% - 8px)">
                    </div>
                </div>
            </div>
            <p>Margin <span>-9</span></p>
        </div> -->
        <!-- <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/quality.png" alt="">
                    <div class="water water-red animated fadeInUp" style="top: calc(100% - 40% - 8px)">
                    </div>
                </div>
            </div>
            <p>Quality <span>-5</span></p>
        </div>
        <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/time.png" alt="">
                    <div class="water animated fadeInUp" style="top: calc(100% - 60% - 8px)">
                    </div>
                </div>
            </div>
            <p>Time <span>10</span></p>
        </div>
        <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/price.png" alt="">
                    <div class="water animated fadeInUp" style="top: calc(100% - 70% - 8px)">
                    </div>
                </div>
            </div>
            <p>Price <span>16</span></p>
        </div>
        <div class="feeding-item">
            <div class="feeding-icon">
                <div class="icon">
                    <img src="<?=THEME_URL.'/assets/'?>images/envir.png" alt="">
                    <div class="water animated fadeInUp" style="top: calc(100% - 60% - 8px)">
                    </div>
                </div>
            </div>
            <p>Environment <span>8</span></p>
        </div> */ ?>
    </div>
</div>
