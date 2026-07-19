<?php

namespace Models;

use Core\Database;
use PDO;

class Provider
{
    protected PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function get($service)
                                {
                                        $stmt = $this->db->prepare("
                                                    SELECT *
                                                                FROM provider_manager
                                                                            WHERE service_name=?
                                                                                        LIMIT 1
                                                                                                ");

                                                                                                        $stmt->execute([$service]);

                                                                                                                return $stmt->fetch();
                                                                                                                    }
                                                                                                                    }