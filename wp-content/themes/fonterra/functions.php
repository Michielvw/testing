<?php
// register vars
$fs = xpress::fileSystem();

// template tags
$fs->requireAll(THEME_DIR . '/template-tags');

// settings
$fs->requireAll(THEME_DIR . '/options', 2);
