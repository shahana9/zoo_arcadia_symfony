<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

// Load cached env vars if the .env.local.php file exists
// Run "composer dump-env prod" to create it (requires symfony/flex >=1.2)
if (is_array($env = @include dirname(__DIR__) . '/.env.local.php')) {
    foreach ($env as $k => $v) {
        $_ENV[$k] = $_SERVER[$k] = $v;
    }
} elseif (!class_exists(Dotenv::class)) {
    throw new \RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    if (file_exists(dirname(__DIR__) . '/.env')) {
        $dotenv = new Dotenv();
        $dotenv->bootEnv(dirname(__DIR__) . '/.env');
    }
}