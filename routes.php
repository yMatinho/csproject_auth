<?php

use Framework\Singleton\Router\Router;

Router::get()->addPost("auth/login", "App\\Modules\\Auth\\Controller\\AuthController@login", "auth.login");
Router::get()->addPost("auth/validate", "App\\Modules\\Auth\\Controller\\AuthController@validate", "auth.validate");