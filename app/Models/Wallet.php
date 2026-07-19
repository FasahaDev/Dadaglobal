<?php

namespace Models;

use Core\Database;
use PDO;

class Wallet
{
    private PDO $db;

        public function __construct()
            {
                    $this->db = Database::connection();
                        }

                            public function balance(int $sid)
                                {
                                        $stmt = $this->db->prepare("
                                                    SELECT sWallet
                                                                FROM subscribers
                                                                            WHERE sId=?
                                                                                        LIMIT 1
                                                                                                ");

                                                                                                        $stmt->execute([$sid]);

                                                                                                                return $stmt->fetchColumn();
                                                                                                                    }

                                                                                                                        public function credit(int $sid, float $amount)
                                                                                                                            {
                                                                                                                                    $stmt = $this->db->prepare("
                                                                                                                                                UPDATE subscribers
                                                                                                                                                            SET sWallet=sWallet+?
                                                                                                                                                                        WHERE sId=?
                                                                                                                                                                                ");

                                                                                                                                                                                        return $stmt->execute([$amount,$sid]);
                                                                                                                                                                                            }

                                                                                                                                                                                                public function debit(int $sid, float $amount)
                                                                                                                                                                                                    {
                                                                                                                                                                                                            $stmt = $this->db->prepare("
                                                                                                                                                                                                                        UPDATE subscribers
                                                                                                                                                                                                                                    SET sWallet=sWallet-?
                                                                                                                                                                                                                                                WHERE sId=?
                                                                                                                                                                                                                                                        ");

                                                                                                                                                                                                                                                                return $stmt->execute([$amount,$sid]);
                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                    }