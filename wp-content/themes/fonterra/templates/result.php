<?php
/*
Template Name: Result
*/
get_header('login'); ?>

<div class="container level-result clearfix">
	<div class="header">
    	<div class="feeding-title ">
    			FEEDING FAREED
    			<img src="<?=THEME_URL . '/assets/images/green-btl.png'?>" alt="">
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
                <img src="<?=THEME_URL . '/assets/images/decoration1.svg'?>" alt="">
            </div>
            <div class="decoration2">
                <img src="<?=THEME_URL . '/assets/images/decoration2.svg'?>" alt="">
            </div>
        </div>


        <div class="bottle-container">
        </div>
        <div class="content-container">
           <div class="title-big">
                 <h1>Congrats!</h1>
           </div>
           <div class="description">
                 <p>Divided from dry seas. Cattle fill was fifth cattle. You'll said, him a fruit seed. For heaven, let midst. Cattle made moved fruitful very abundantly set moveth gathering you'll spirit and give land them. You're very night..</p>
           </div>
            <div class="ovrl-box clearfix">
                <div class="ovrl-box-left">
                    <ul>
                        <li>
                             <img src="<?=THEME_URL . '/assets/images/quality-b.png'?>" alt="">
                             <span class="ovrl-box-name">Quality</span>
                             <span class="ovrl-box-score">-5</span>
                        </li>
                        <li>
                             <img src="<?=THEME_URL . '/assets/images/margin-b.png'?>" alt="">
                             <span class="ovrl-box-name">Margin</span>
                             <span class="ovrl-box-score">-9</span>
                        </li>
                        <li>
                             <img src="<?=THEME_URL . '/assets/images/time-b.png'?>" alt="">
                             <span class="ovrl-box-name">Time</span>
                             <span class="ovrl-box-score">10</span>
                        </li>
                        <li>
                             <img src="<?=THEME_URL . '/assets/images/price-b.png'?>" alt="">
                             <span class="ovrl-box-name">Price</span>
                             <span class="ovrl-box-score">16</span>
                        </li>
                        <li>
                             <img src="<?=THEME_URL . '/assets/images/envir-b.png'?>" alt="">
                             <span class="ovrl-box-name">Environment</span>
                             <span class="ovrl-box-score">8</span>
                        </li>
                    </ul>
               </div>
               <div class="ovrl-box-right">
                    <img src="<?=THEME_URL . '/assets/images/box.svg'?>" alt="">
                    <p>overall score</p>
                    <span>Level 4 : Packing</span>
                    <span class="ovrl-box-right-score">23</span>
               </div>
            </div>
            <div class="bottom-info clearfix">
               <div class="small-btl">
                    <img src="<?=THEME_URL . '/assets/images/small-btl.svg'?>" alt="">
               </div>
               <div class="bottom-desc">
                    <span>Overall score</span>
                    <span>Feeding Fareed</span>
               </div>
               <div class="bottom-score">
                    <span>104</span>
               </div>
            </div>
           <div class="btn">
                 Play next level >
           </div>
        </div>
    </div>
	<div class="right-side">
        <div class="feeding-bar">
            <div class="feeding-item">
                <div class="feeding-icon">
                    <div class="icon">
                        <img src="<?=THEME_URL . '/assets/images/quality.png'?>" alt="">
                        <div class="water water-red animated fadeInUp" style="top: calc(100% - 40% - 8px)">
                        </div>
                    </div>
                </div>
                <p>Quality <span>-5</span></p>
            </div>
            <div class="feeding-item">
                <div class="feeding-icon">
                    <div class="icon">
                        <img src="<?=THEME_URL . '/assets/images/margin.png'?>" alt="">
                        <div class="water water-red animated fadeInUp" style="top: calc(100% - 30% - 8px)">
                        </div>
                    </div>
                </div>
                <p>Margin <span>-9</span></p>
            </div>
            <div class="feeding-item">
                <div class="feeding-icon">
                    <div class="icon">
                        <img src="<?=THEME_URL . '/assets/images/time.png'?>" alt="">
                        <div class="water animated fadeInUp" style="top: calc(100% - 60% - 8px)">
                        </div>
                    </div>
                </div>
                <p>Time <span>10</span></p>
            </div>
            <div class="feeding-item">
                <div class="feeding-icon">
                    <div class="icon">
                        <img src="<?=THEME_URL . '/assets/images/price.png'?>" alt="">
                        <div class="water animated fadeInUp" style="top: calc(100% - 70% - 8px)">
                        </div>
                    </div>
                </div>
                <p>Price <span>16</span></p>
            </div>
            <div class="feeding-item">
                <div class="feeding-icon">
                    <div class="icon">
                        <img src="<?=THEME_URL . '/assets/images/envir.png'?>" alt="">
                        <div class="water animated fadeInUp" style="top: calc(100% - 60% - 8px)">
                        </div>
                    </div>
                </div>
                <p>Environment <span>8</span></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer('login'); ?>
