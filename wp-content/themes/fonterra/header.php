<?php
global $game_data;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = yes">
        <title><?php bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <?php if(is_page('fonterra')){
        $background_image = THEME_URL.'/assets/images/home-bg.jpg';
    }
    elseif (is_page('login')) {
         $background_image = '';
     }
    else {
        $level_bg = get_field('background_image', 'level_'.$game_data->current_level_id);
        if( ! empty($level_bg['url']))
        {
            $background_image = $level_bg['url'];
        }
        else
        {
            $background_image = THEME_URL.'/assets/images/bg1.jpg';
        }
    }
    ?>
<body style="background-image: url('<?=$background_image?>');">
