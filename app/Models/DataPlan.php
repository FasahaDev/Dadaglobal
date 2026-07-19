<?php

namespace Models;

use Core\Database;
use PDO;

class DataPlan
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
                                                                FROM dataplans
                                                                            WHERE status='On'
                                                                                        ORDER BY networkid ASC
                                                                                                ");

                                                                                                        return $stmt->fetchAll();
                                                                                                            }

                                                                                                                public function find($id)
                                                                                                                    {
                                                                                                                            $stmt = $this->db->prepare("
                                                                                                                                        SELECT *
                                                                                                                                                    FROM dataplans
                                                                                                                                                                WHERE id=?
                                                                                                                                                                            LIMIT 1
                                                                                                                                                                                    ");

                                                                                                                                                                                            $stmt->execute([$id]);

                                                                                                                                                                                                    return $stmt->fetch();
                                                                                                                                                                                                        }
                                                                                                                                                                                                        }