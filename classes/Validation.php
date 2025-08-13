<?php

class Validator
{
    private $name;
    private $value;
    private $error = [];

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function required()
    {
        if ($this->value === null || $this->value === '') {
            $this->error[] = "Campo {$this->name} é obrigatório.";
        }
        return $this;
    }

    public function string()
    {
        if ($this->value !== null && $this->value !== '') {
            if (!is_string($this->value)) {
                $this->error[] = "Campo {$this->name} deve ser uma string.";
            }
        }
        return $this;
    }

    public function numeric()
    {
        if ($this->value !== null && $this->value !== '') {
            if (!is_numeric($this->value)) {
                $this->error[] = "Campo {$this->name} deve ser numérico.";
            }
        }
        return $this;
    }

    public function integer()
    {
        if ($this->value !== null && $this->value !== '') {
            if (filter_var($this->value, FILTER_VALIDATE_INT) === false) {
                $this->error[] = "Campo {$this->name} deve ser um número inteiro.";
            }
        }
        return $this;
    }

    public function decimal()
    {
        if ($this->value !== null && $this->value !== '') {
            if (filter_var($this->value, FILTER_VALIDATE_FLOAT) === false) {
                $this->error[] = "Campo {$this->name} deve ser um número decimal.";
            }
        }
        return $this;
    }

    public function date($format)
    {
        if ($this->value !== null && $this->value !== '') {
            $d = DateTime::createFromFormat($format, $this->value);
            if (!($d && $d->format($format) === $this->value)) {
                $this->error[] = "Campo {$this->name} deve ser uma data válida no formato {$format}.";
            }
        }
        return $this;
    }

    public function in($values)
    {
        if ($this->value !== null && $this->value !== '') {
            if (!in_array($this->value, explode(',', $values), true)) {
                $this->error[] = "O valor do campo {$this->name} não é válido.";
            }
        }
        return $this;
    }

    public function min($min)
    {
        if ($this->value !== null && $this->value !== '') {
            $min = (float) $min;

            if (is_numeric($this->value) && $this->value < $min) {
                $this->error[] = "Campo {$this->name} deve ser no mínimo {$min}.";
            }

            if (is_string($this->value) && mb_strlen($this->value, 'UTF-8') < $min) {
                $this->error[] = "Campo {$this->name} deve ter no mínimo {$min} caracteres.";
            }
        }
        return $this;
    }

    public function max($max)
    {
        if ($this->value !== null && $this->value !== '') {
            $max = (float) $max;

            if (is_numeric($this->value) && $this->value > $max) {
                $this->error[] = "Campo {$this->name} deve ser no máximo {$max}.";
            }

            if (is_string($this->value) && mb_strlen($this->value, 'UTF-8') > $max) {
                $this->error[] = "Campo {$this->name} deve ter no máximo {$max} caracteres.";
            }
        }
        return $this;
    }

    public function length($lengths)
    {
        if ($this->value !== null && $this->value !== '') {
            $length = mb_strlen($this->value, 'UTF-8');
            $lengths = explode(',', $lengths);

            if (!in_array((string) $length, $lengths, true)) {
                $this->error[] = "Campo {$this->name} deve ter " . implode(' ou ', $lengths) . " caracteres.";
            }
        }
        return $this;
    }

    public function exists($table, $column)
    {
        if ($this->value !== null && $this->value !== '') {
            try {
                $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :value LIMIT 1";
                $stmt = Database::prepare($sql);
                $stmt->execute(['value' => $this->value]);

                if ($stmt->fetchColumn() == 0) {
                    $this->error[] = "O valor do campo {$this->name} nao existe.";
                }
            } catch (Throwable $e) {
                error_log('Erro na validação de existência: ' . $e->getMessage());
                $this->error[] = "Erro ao validar o campo {$this->name}.";
            }
        }
        return $this;
    }

    public function unique($table, $column)
    {
        if ($this->value !== null && $this->value !== '') {
            try {
                $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :value LIMIT 1";
                $stmt = Database::prepare($sql);
                $stmt->execute(['value' => $this->value]);

                if ($stmt->fetchColumn() > 0) {
                    $this->error[] = "O valor do campo {$this->name} já existe.";
                }
            } catch (Throwable $e) {
                error_log('Erro na validação de unicidade: ' . $e->getMessage());
                $this->error[] = "Erro ao validar o campo {$this->name}.";
            }
        }
        return $this;
    }

    public function hasErrors()
    {
        return !empty($this->error);
    }

    public function getErrors()
    {
        return $this->error;
    }
}