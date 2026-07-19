<?php

namespace Models;

use Core\Database;
use PDO;

class Transaction
{
    private PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function create(array $data)
                                {
                                        $stmt = $this->db->prepare("
                                                INSERT INTO transactions
                                                        (
                                                                    sId,
                                                                                transref,
                                                                                            servicename,
                                                                                                        servicedesc,
                                                                                                                    amount,
                                                                                                                                status,
                                                                                                                                            oldbal,
                                                                                                                                                        newbal,
                                                                                                                                                                    profit,
                                                                                                                                                                                date
                                                                                                                                                                                        )
                                                                                                                                                                                                VALUES
                                                                                                                                                                                                        (
                                                                                                                                                                                                                    ?,?,?,?,?,?,?,?,?,NOW()
                                                                                                                                                                                                                            )
                                                                                                                                                                                                                                    ");

                                                                                                                                                                                                                                            return $stmt->execute([
                                                                                                                                                                                                                                                        $data['sid'],
                                                                                                                                                                                                                                                                    $data['reference'],
                                                                                                                                                                                                                                                                                $data['service'],
                                                                                                                                                                                                                                                                                            $data['description'],
                                                                                                                                                                                                                                                                                                        $data['amount'],
                                                                                                                                                                                                                                                                                                                    $data['status'],
                                                                                                                                                                                                                                                                                                                                $data['old_balance'],
                                                                                                                                                                                                                                                                                                                                            $data['new_balance'],
                                                                                                                                                                                                                                                                                                                                                        $data['profit']
                                                                                                                                                                                                                                                                                                                                                                ]);
                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                        public function history(int $sid)
                                                                                                                                                                                                                                                                                                                                                                            {
                                                                                                                                                                                                                                                                                                                                                                                    $stmt = $this->db->prepare("
                                                                                                                                                                                                                                                                                                                                                                                                SELECT *
                                                                                                                                                                                                                                                                                                                                                                                                            FROM transactions
                                                                                                                                                                                                                                                                                                                                                                                                                        WHERE sId=?
                                                                                                                                                                                                                                                                                                                                                                                                                                    ORDER BY tid DESC
                                                                                                                                                                                                                                                                                                                                                                                                                                            ");

                                                                                                                                                                                                                                                                                                                                                                                                                                                    $stmt->execute([$sid]);

                                                                                                                                                                                                                                                                                                                                                                                                                                                            return $stmt->fetchAll();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                }