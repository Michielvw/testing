<?php
global $game_data;
?>
<div class="bottle-container">
    <div class="bottle">
        <img class="pacifier" src="<?=THEME_URL.'/assets/'?>images/pacifier.png" alt="">
        <div class="ovrl-score">
            <span>Overall Score</span>
            <span class="score">
                <?php
                $levels_score = get_post_meta($game_data->ID, 'levels_score', TRUE);
                echo array_sum($levels_score);
                ?>
            </span>
        </div>
        <div class="bottle-content">
            <?php
                $scores = get_post_meta($game_data->ID, 'levels_score', TRUE);
                $level = tr_taxonomy('level');
                $terms = get_terms( array(
                        'taxonomy' => 'level',
                        'hide_empty' => false,
                        'order' => get_field('level')
                    ));
                $current_level_id = get_post_meta($game_data->ID, 'current_level_id', TRUE);
                    foreach ($terms as $key) {
                        ?>
                        <div class="btl-item <?=($key->term_id == $current_level_id) ? 'active' : ''?>">
                            <?php
                            $icon   = get_field( 'level_icon','level_'.$key->term_id);
                            $icon2  = get_field( 'level_icon_white','level_'.$key->term_id);
                            $level_score = @$scores[$key->term_id];
                            ?>
                            <div class="btl-icons">
                                <img src=" <?php echo $icon['url']; ?> " alt="" class="btl-icon-blue">
                                <img src=" <?php echo $icon2['url']; ?> " alt="" class="btl-icon-white">
                            </div>
                            <span class="item-name"><?php echo $key->name;?></span>
                            <span class="item-score"><?=(int)$level_score?></span>
                        </div><?php
                    }
            ?>
        </div>
    </div>
</div>
