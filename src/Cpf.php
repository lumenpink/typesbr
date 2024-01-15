<?php

namespace Lumenpink\Typesbr;

final class Cpf implements TypesbrInterface
{
    private string $cpf;
    public function __construct(string $cpf)
    {
        if (empty($cpf)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }
        $this->cpf = $cpf;
        $this->normalize();
        if (!self::validate($this->cpf)) {
            throw new \InvalidArgumentException('Invalid CPF');
        }
    }
    public function normalize()
    {
        // Clear var to keep only digits and pad leading zeroes
        $this->cpf = preg_replace('/\D/', '', $this->cpf);
        $this->cpf = str_pad($this->cpf, 11, '0', STR_PAD_LEFT);
    }
    public function format()
    {
        $result  = substr($this->cpf, 0, 3) . '.';
        $result .= substr($this->cpf, 3, 3) . '.';
        $result .= substr($this->cpf, 6, 3) . '-';
        $result .= substr($this->cpf, 9, 2) . '';
        return $result;
    }
    /*
    Returns the CPF without mask
    */
    public function __toString(): string
    {
        return $this->cpf;
    }
    public static function validate($cpf)
    {
        if (empty($cpf)) {
            return false;
        }
        // verify if there are 11 digits left
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return false;
            // Calculate the verification digit
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += intval($cpf[$c]) * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if (intval($cpf[$c]) !== $d) {
                    return false;
                }
            }
            return true;
        }
    }
}
