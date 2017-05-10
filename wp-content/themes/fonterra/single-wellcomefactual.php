<?php

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
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="scrollable">
               <div class="title-big">
         				<h1> <?= the_title(); ?> </h1>
         		</div>
         		<div class="description">
         				<?php the_content(); ?>
         		</div>
            </div>

            <?php
                $continuepage = get_field('wellcome');
                if( $continuepage ):
            	// override $post
            	$post = $continuepage;
            	setup_postdata( $post );
        	?>
            <a href= "<?php the_permalink(); ?>">
                <div class="btn">
                    Continue game >
                </div>
            </a>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; endwhile; endif; ?>


        </div>
    </div>

</div>

<?php get_footer(); ?>
