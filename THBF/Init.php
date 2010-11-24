<?php

// First off, include the framework.
include "Theme.php";
include "lib/Form.php";
include "Config.php";

// Secondly, setup the theme menu.
$theme->theme_menu = $config;

// Run!
$theme->run();