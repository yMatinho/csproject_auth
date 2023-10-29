<?php

use Framework\Singleton\Router\Router;

Router::get()->addPost("auth/login", "App\\Modules\\Auth\\Controller\\AuthController@login", "auth.login");