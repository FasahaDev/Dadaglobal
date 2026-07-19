<?php

namespace Core;

class Validator
{
    private array $errors = [];

        public function required(array $data, array $fields): self
            {
                    foreach ($fields as $field) {
                                if (!isset($data[$field]) || trim((string)$data[$field]) === '') {
                                                $this->errors[$field] = ucfirst($field) . ' is required';
                                                            }
                                                                    }

                                                                            return $this;
                                                                                }

                                                                                    public function email(string $field, ?string $value): self
                                                                                        {
                                                                                                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                                                                                            $this->errors[$field] = 'Invalid email address';
                                                                                                                    }

                                                                                                                            return $this;
                                                                                                                                }

                                                                                                                                    public function min(string $field, ?string $value, int $length): self
                                                                                                                                        {
                                                                                                                                                if (!empty($value) && strlen($value) < $length) {
                                                                                                                                                            $this->errors[$field] = ucfirst($field) . " must be at least {$length} characters";
                                                                                                                                                                    }

                                                                                                                                                                            return $this;
                                                                                                                                                                                }

                                                                                                                                                                                    public function numeric(string $field, ?string $value): self
                                                                                                                                                                                        {
                                                                                                                                                                                                if (!empty($value) && !is_numeric($value)) {
                                                                                                                                                                                                            $this->errors[$field] = ucfirst($field) . ' must be numeric';
                                                                                                                                                                                                                    }

                                                                                                                                                                                                                            return $this;
                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                    public function passes(): bool
                                                                                                                                                                                                                                        {
                                                                                                                                                                                                                                                return empty($this->errors);
                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                        public function errors(): array
                                                                                                                                                                                                                                                            {
                                                                                                                                                                                                                                                                    return $this->errors;
                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        }