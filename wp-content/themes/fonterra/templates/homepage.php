<?php
/*
Template Name: Homepage
*/
get_header(); ?>

<div class="container homepage clearfix">
	<div class="header">
		<div class="feeding-title ">
			FEEDING FAREED
			<img src="<?=THEME_URL.'/assets/'?>images/green-btl.png" alt="">
		</div>
		<div class="menu">
			<ul>
				<?php wp_nav_menu();	?>
				<!-- <a href="#"><li>view scorecard</li></a>
				<a href="#"><li>info</li></a>
				<a href="#"><li>contact</li></a> -->
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
	<div class="content-container">
		<?php

		if ( have_posts() ) : while ( have_posts() ) : the_post();
		$video_url      = get_field('vimeo_url','option');
		$vimeo_embed    = wp_oembed_get( $video_url);
		?>
		<div class="title-big">
			<h1><?= the_title(); ?></h1>
		</div>
		<div class="description">
			<p><?php the_content(); ?></p>
		</div>
		<!-- <div class="video">
            <i class="fa fa-play-circle-o video-link"  aria-hidden="true" href="<?= $video_url ?>"></i>
            <span> Watch intro </span>
		</div> -->

		<?php
		$login_url = BASE_URL. '/level-intro/';
		$start_game = get_field('start_game');
		if( $start_game ):
			// override $post
			$post = $start_game;
			setup_postdata( $post );
			?>
			<!-- <a href= "<?= $login_url ?>">
				<div class="btn">
					Play game!
				</div>
			</a> -->

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; endwhile; endif; ?>
	</div>

	<div class="video-container">
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		$video_url      = get_field('vimeo_url','option');
		$vimeo_embed    = wp_oembed_get( $video_url);
		?>
	    <div class="video">
					<a class="video-icon video-link" href="<?= $video_url ?>">
						<i class="fa fa-play" aria-hidden="true"></i>
					</a>

	        <span> Watch intro </span>
	    </div>
		<?php endwhile; endif; ?>

	    <a class="button-box" href= "<?= $login_url ?>">
	        <div class="btn">
	            Play game!
	        </div>
	    </a>
	</div>

	<div class="popover-container">
		<img src="<?=THEME_URL.'/assets/'?>images/dotted.png" alt="">
        <div class="pops pop1">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text">
                <span>Level 1 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop2">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text">
                <span>Level 2 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop3">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text">
                <span>Level 3 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop4">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text">
                <span>Level 4 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop5">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text">
                <span>Level 5 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop6">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text pop-left">
                <span>Level 6 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop7">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text pop-left">
                <span>Level 7 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
        <div class="pops pop8">
            <div class="dot">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="pop-text pop-left">
                <span>Level 8 : Farm</span>
                <p>Farm, the farm is where the magic begins. Grass turns into gold we call milk.</p>
            </div>
        </div>
	</div>

</div>

<?php get_footer(); ?>
