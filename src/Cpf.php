<?php

namespace Lumenpink\Typesbr;

final class Cpf implements TypesbrInterface
{
    private string $cpf;
    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
        $this->normalize();
        $this->validate();
    }
    private function normalize(): void
    {
        // Clear var to keep only digits and pad leading zeroes
        $this->cpf = preg_replace('/\D/', '', $this->cpf);
        $this->cpf = str_pad($this->cpf, 11, '0', STR_PAD_LEFT);
    }
    public function digits(): string
    {
        return $this->cpf;
    }

    public function formatted(): string
    {
        return  substr($this->cpf, 0, 3) . '.' .
            substr($this->cpf, 3, 3) . '.' .
            substr($this->cpf, 6, 3) . '-' .
            substr($this->cpf, 9, 2) . '';
    }
    /*
    Returns the type of the document
    */
    public function type(): string
    {
        return 'cpf';
    }
    /*
    Returns the CPF without mask
    */
    public function __toString(): string
    {
        return $this->cpf;
    }
    public function validate(): void
    {
        if (empty($this->cpf)) {
            throw new \InvalidArgumentException('CPF cannot be empty');
        }
        // verify if there are 11 digits left
        if (strlen($this->cpf) !== 11) {
            throw new \InvalidArgumentException('CPF cannot must have 11 digits');
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $this->cpf == '00000000000' ||
            $this->cpf == '11111111111' ||
            $this->cpf == '22222222222' ||
            $this->cpf == '33333333333' ||
            $this->cpf == '44444444444' ||
            $this->cpf == '55555555555' ||
            $this->cpf == '66666666666' ||
            $this->cpf == '77777777777' ||
            $this->cpf == '88888888888' ||
            $this->cpf == '99999999999'
        ) {
            throw new \InvalidArgumentException('Invalid CPF');
            // Calculate the verification digit
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += intval($this->cpf[$c]) * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if (intval($this->cpf[$c]) !== $d) {
                    throw new \InvalidArgumentException('Invalid CPF');
                }
            }
        }
    }
}
