<?php

require("vendor/autoload.php");

define("MAIN_DIR", __DIR__.'/');
define("SITE_URL", "http://localhost:8081/");
define("USER_SERVICE_URL", "http://users_api/");

define("DB_DATABASE", "");
define("DB_USERNAME", "");
define("DB_PASSWORD", "");
define("DB_PORT", null);
define("DB_HOST", "");

define("TOKEN_HOURS_EXPIRATION", 2);
define("JWT_SIGNING_KEY", "jd6zneH741Tyufcyv50BeGRztiCmnC3dQn30XufcE2MNCdr6aihcgz0pXuujtvwx");

spl_autoload_register(function($class) {
    $class = str_replace("\\","/", $class);
    if(!file_exists(MAIN_DIR.'src/' . $class . '.php'))
        return;
    include MAIN_DIR.'src/' . $class . '.php';
});