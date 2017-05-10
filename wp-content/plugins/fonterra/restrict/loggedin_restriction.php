<?php
if (is_page('register') || is_page('activate') || is_page(get_field('registration_thankyou_page', 'option'))) $this->redirect();
