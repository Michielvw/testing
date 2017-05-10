<?php
/*
Template Name: login
*/
get_header('login'); ?>


<div class="container login-page clearfix">
    <div class="header">
        <div class="feeding-title ">
            FEEDING FAREED
            <img src="<?=THEME_URL . '/assets/images/green-btl.png'?>" alt="">
        </div>
        <!-- <div class="menu">
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
        </nav> -->

    </div>
    <div class="full-side">
        <div class="decoration">
            <div class="decoration1">
                <img src="<?=THEME_URL . '/assets/images/decoration1.svg'?>" alt="">
            </div>
            <div class="decoration2">
                <img src="<?=THEME_URL . '/assets/images/decoration2.svg'?>" alt="">
            </div>
        </div>
        <div class="content-container">
            <div class="title-medium">
                <h1>Welcome to Feeding Farid!</h1>
            </div>
            <div class="description">
                <p>You are packing cheese for the Asian market.
                The customers in China go to the store to get their groceries almost every day.</p>
            </div>
            <div class="login-box">
                <form  action="#" method="POST" class="login">
                    <label for=""></label>
                    <input type="text" name="username" id="" placeholder="email" class="email" required>
                    <label for=""></label>
                    <input type="password" name="password" id="" placeholder="password" class="pass" required>
                    <button type="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
    <div class="wave">
    </div>
    <div class="wave wave-big">
    </div>

</div>

<?php get_footer('login'); ?>
