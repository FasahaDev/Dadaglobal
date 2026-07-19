<?php

namespace Models;

use Core\Database;
use PDO;

class User
{
    protected PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function findByEmail(string $email)
                                {
                                        $stmt = $this->db->prepare(
                                                    "SELECT * FROM subscribers WHERE sEmail = ? LIMIT 1"
                                                            );

                                                                    $stmt->execute([$email]);

                                                                            return $stmt->fetch();
                                                                                }

                                                                                    public function findById(int $id)
                                                                                        {
                                                                                                $stmt = $this->db->prepare(
                                                                                                            "SELECT * FROM subscribers WHERE sId = ? LIMIT 1"
                                                                                                                    );

                                                                                                                            $stmt->execute([$id]);

                                                                                                                                    return $stmt->fetch();
                                                                                                                                        }

                                                                                                                                            public function create(array $data)
                                                                                                                                                {
                                                                                                                                                        $stmt = $this->db->prepare("
                                                                                                                                                                    INSERT INTO subscribers
                                                                                                                                                                                (
                                                                                                                                                                                                sName,
                                                                                                                                                                                                                sPhone,
                                                                                                                                                                                                                                sEmail,
                                                                                                                                                                                                                                                sPass,
                                                                                                                                                                                                                                                                sState,
                                                                                                                                                                                                                                                                                sType,
                                                                                                                                                                                                                                                                                                sWallet
                                                                                                                                                                                                                                                                                                            )
                                                                                                                                                                                                                                                                                                                        VALUES
                                                                                                                                                                                                                                                                                                                                    (
                                                                                                                                                                                                                                                                                                                                                    ?,?,?,?,?,?,?
                                                                                                                                                                                                                                                                                                                                                                )
                                                                                                                                                                                                                                                                                                                                                                        ");

                                                                                                                                                                                                                                                                                                                                                                                return $stmt->execute([
                                                                                                                                                                                                                                                                                                                                                                                            $data['name'],
                                                                                                                                                                                                                                                                                                                                                                                                        $data['phone'],
                                                                                                                                                                                                                                                                                                                                                                                                                    $data['email'],
                                                                                                                                                                                                                                                                                                                                                                                                                                password_hash($data['password'], PASSWORD_BCRYPT),
                                                                                                                                                                                                                                                                                                                                                                                                                                            $data['state'],
                                                                                                                                                                                                                                                                                                                                                                                                                                                        'USER',
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    0
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ]);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }