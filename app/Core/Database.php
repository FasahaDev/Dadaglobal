<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

        public static function connection(): PDO
            {
                    if (self::$connection === null) {

                                $config = require __DIR__ . '/../config/database.php';

                                            $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";

                                                        try {

                                                                        self::$connection = new PDO(
                                                                                            $dsn,
                                                                                                                $config['username'],
                                                                                                                                    $config['password'],
                                                                                                                                                        [
                                                                                                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                                                                                                                                                                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                                                                                                                                                                                                                PDO::ATTR_EMULATE_PREPARES => false,
                                                                                                                                                                                                                                                    ]
                                                                                                                                                                                                                                                                    );

                                                                                                                                                                                                                                                                                } catch (PDOException $e) {

                                                                                                                                                                                                                                                                                                die("Database Connection Failed: " . $e->getMessage());

                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                            return self::$connection;
                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                }