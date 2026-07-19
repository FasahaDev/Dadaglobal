<?php

namespace Services;

use Models\Withdrawal;
use Models\Wallet;
use Models\Transaction;

class WithdrawService
{
    protected Wallet $wallet;
        protected Withdrawal $withdrawal;
            protected Transaction $transaction;

                public function __construct()
                    {
                            $this->wallet = new Wallet();
                                    $this->withdrawal = new Withdrawal();
                                            $this->transaction = new Transaction();
                                                }

                                                    public function request(array $data)
                                                        {
                                                                $balance = $this->wallet->balance($data['sid']);

                                                                        if ($balance < $data['amount']) {
                                                                                    return [
                                                                                                    'success' => false,
                                                                                                                    'message' => 'Insufficient wallet balance'
                                                                                                                                ];
                                                                                                                                        }

                                                                                                                                                $oldBalance = $balance;
                                                                                                                                                        $newBalance = $oldBalance - $data['amount'];

                                                                                                                                                                $this->wallet->debit($data['sid'], $data['amount']);

                                                                                                                                                                        $reference = 'WD' . time() . rand(1000,9999);

                                                                                                                                                                                $this->withdrawal->create([
                                                                                                                                                                                            'sid' => $data['sid'],
                                                                                                                                                                                                        'reference' => $reference,
                                                                                                                                                                                                                    'account_name' => $data['account_name'],
                                                                                                                                                                                                                                'account_number' => $data['account_number'],
                                                                                                                                                                                                                                            'bank_code' => $data['bank_code'],
                                                                                                                                                                                                                                                        'bank_name' => $data['bank_name'],
                                                                                                                                                                                                                                                                    'amount' => $data['amount'],
                                                                                                                                                                                                                                                                                'charge' => 0,
                                                                                                                                                                                                                                                                                            'status' => 'pending',
                                                                                                                                                                                                                                                                                                        'provider' => $data['provider'],
                                                                                                                                                                                                                                                                                                                    'narration' => 'Wallet Withdrawal'
                                                                                                                                                                                                                                                                                                                            ]);

                                                                                                                                                                                                                                                                                                                                    $this->transaction->create([
                                                                                                                                                                                                                                                                                                                                                'sid' => $data['sid'],
                                                                                                                                                                                                                                                                                                                                                            'reference' => $reference,
                                                                                                                                                                                                                                                                                                                                                                        'service' => 'Withdrawal',
                                                                                                                                                                                                                                                                                                                                                                                    'description' => 'Wallet Withdrawal',
                                                                                                                                                                                                                                                                                                                                                                                                'amount' => $data['amount'],
                                                                                                                                                                                                                                                                                                                                                                                                            'status' => 'pending',
                                                                                                                                                                                                                                                                                                                                                                                                                        'old_balance' => $oldBalance,
                                                                                                                                                                                                                                                                                                                                                                                                                                    'new_balance' => $newBalance,
                                                                                                                                                                                                                                                                                                                                                                                                                                                'profit' => 0
                                                                                                                                                                                                                                                                                                                                                                                                                                                        ]);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                return [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            'success' => true,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        'reference' => $reference,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    'message' => 'Withdrawal request submitted'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }