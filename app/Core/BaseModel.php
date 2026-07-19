<?php

namespace Core;

abstract class BaseModel
{
    protected $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }
                        }