<?php

namespace Lumenpink\Typesbr;

final class Cnpj implements TypesbrInterface
{
    private string $cnpj;

    public function __construct(string $cnpj)
    {
        $this->cnpj = $cnpj;
        $this->normalize();
        $this->validate();
    }

    private function normalize(): void
    {
        // Clear var to keep only digits and pad leading zeroes
        $this->cnpj = preg_replace('/\D/', '', $this->cnpj);
        $this->cnpj = str_pad($this->cnpj, 14, '0', STR_PAD_LEFT);
    }

    public function digits(): string
    {
        return $this->cnpj;
    }

    public function formatted(): string
    {
        return
            substr($this->cnpj, 0, 2) . '.' .
            substr($this->cnpj, 2, 3) . '.' .
            substr($this->cnpj, 5, 3) . '/' .
            substr($this->cnpj, 8, 4) . '-' .
            substr($this->cnpj, 12, 2);
    }

    /*
    Returns the type of the document
    */
    public function type(): string
    {
        return 'cnpj';
    }

    /*
    Returns the CNPJ without mask
    */
    public function __toString(): string
    {
        return $this->cnpj;
    }

    public function validate(): void
    {
        if (empty($this->cnpj)) {
            throw new \InvalidArgumentException('CNPJ cannot be empty');
        }
        // verify if there are 11 digits left
        if (strlen($this->cnpj) !== 14) {
            throw new \InvalidArgumentException('CNPJ cannot must have 11 digits');
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        elseif (
            $this->cnpj == '00000000000' ||
            $this->cnpj == '11111111111' ||
            $this->cnpj == '22222222222' ||
            $this->cnpj == '33333333333' ||
            $this->cnpj == '44444444444' ||
            $this->cnpj == '55555555555' ||
            $this->cnpj == '66666666666' ||
            $this->cnpj == '77777777777' ||
            $this->cnpj == '88888888888' ||
            $this->cnpj == '99999999999'
        ) {
            throw new \InvalidArgumentException('Invalid CNPJ');
            // Calculate the verification digit
        } else {
            for ($t = 12; $t < 14; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += intval($this->cnpj[$c]) * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if (intval($this->cnpj[$c]) !== $d) {
                    throw new \InvalidArgumentException('Invalid CNPJ');
                }
            }
        }
    }
}
