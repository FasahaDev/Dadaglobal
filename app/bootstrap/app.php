<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
        }

        date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'Africa/Lagos');