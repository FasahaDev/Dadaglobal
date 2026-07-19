<?php

namespace Models;

use Core\Database;
use PDO;

class Bank
{
    protected PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function all()
                                {
                                        $stmt = $this->db->query("
                                                    SELECT *
                                                                FROM bank_list
                                                                            WHERE status=1
                                                                                        ORDER BY bank_name ASC
                                                                                                ");

                                                                                                        return $stmt->fetchAll();
                                                                                                            }

                                                                                                                public function findByCode($code)
                                                                                                                    {
                                                                                                                            $stmt = $this->db->prepare("
                                                                                                                                        SELECT *
                                                                                                                                                    FROM bank_list
                                                                                                                                                                WHERE bank_code=?
                                                                                                                                                                            LIMIT 1
                                                                                                                                                                                    ");

                                                                                                                                                                                            $stmt->execute([$code]);

                                                                                                                                                                                                    return $stmt->fetch();
                                                                                                                                                                                                        }
                                                                                                                                                                                                        }