<?php

namespace Models;

use Core\Database;
use PDO;

class ReservedAccount
{
    private PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function findByUser(int $sid)
                                {
                                        $stmt = $this->db->prepare("
                                                    SELECT *
                                                                FROM reserved_accounts
                                                                            WHERE sid=?
                                                                                        LIMIT 1
                                                                                                ");

                                                                                                        $stmt->execute([$sid]);

                                                                                                                return $stmt->fetch();
                                                                                                                    }

                                                                                                                        public function create(array $data)
                                                                                                                            {
                                                                                                                                    $stmt = $this->db->prepare("
                                                                                                                                                INSERT INTO reserved_accounts
                                                                                                                                                            (
                                                                                                                                                                            sid,
                                                                                                                                                                                            account_name,
                                                                                                                                                                                                            account_number,
                                                                                                                                                                                                                            bank_name,
                                                                                                                                                                                                                                            provider,
                                                                                                                                                                                                                                                            reference,
                                                                                                                                                                                                                                                                            status
                                                                                                                                                                                                                                                                                        )
                                                                                                                                                                                                                                                                                                    VALUES
                                                                                                                                                                                                                                                                                                                (
                                                                                                                                                                                                                                                                                                                                ?,?,?,?,?,?,?
                                                                                                                                                                                                                                                                                                                                            )
                                                                                                                                                                                                                                                                                                                                                    ");

                                                                                                                                                                                                                                                                                                                                                            return $stmt->execute([
                                                                                                                                                                                                                                                                                                                                                                        $data['sid'],
                                                                                                                                                                                                                                                                                                                                                                                    $data['account_name'],
                                                                                                                                                                                                                                                                                                                                                                                                $data['account_number'],
                                                                                                                                                                                                                                                                                                                                                                                                            $data['bank_name'],
                                                                                                                                                                                                                                                                                                                                                                                                                        $data['provider'],
                                                                                                                                                                                                                                                                                                                                                                                                                                    $data['reference'],
                                                                                                                                                                                                                                                                                                                                                                                                                                                $data['status']
                                                                                                                                                                                                                                                                                                                                                                                                                                                        ]);
                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                            }