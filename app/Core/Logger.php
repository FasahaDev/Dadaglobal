<?php

namespace Core;

class Logger
{
    public static function write($message)
        {
                $file = __DIR__ . '/../logs/app.log';

                        file_put_contents(
                                    $file,
                                                "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL,
                                                            FILE_APPEND
                                                                    );
                                                                        }
                                                                        }