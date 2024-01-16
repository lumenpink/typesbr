<?php

namespace Lumenpink\Typesbr;

final class Registrationsc implements TypesbrInterface
{
    private string $registrationsc;
    public function __construct(string $registrationsc)
    {
        $this->registrationsc = $registrationsc;
        $this->normalize();
        $this->validate();
    }
    private function normalize(): void
    {
        // Clear var to keep only digits and pad leading zeroes
        $this->registrationsc = preg_replace('/\D/', '', $this->registrationsc);
        $this->registrationsc = str_pad($this->registrationsc, 7, '0', STR_PAD_LEFT);
    }
    public function digits(): string
    {
        return $this->registrationsc;
    }

    public function formatted(): string
    {
        return  substr($this->registrationsc, 0, 3) . '.' .
            substr($this->registrationsc, 3, 3) . '-' .
            substr($this->registrationsc, 6, 1) ;
    }
    /*
    Returns the type of the document
    */
    public function type(): string
    {
        return 'registrationsc';
    }
    /*
    Returns the Registration without mask
    */
    public function __toString(): string
    {
        return $this->registrationsc;
    }
    public function validate(): void
    {
        if (empty($this->registrationsc)) {
            throw new \InvalidArgumentException('Registration cannot be empty');
        }
        // verify if there are 11 digits left
        if (strlen($this->registrationsc) !== 7) {
            throw new \InvalidArgumentException('Registration cannot must have 7 digits');
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $this->registrationsc == '0000000' ||
            $this->registrationsc == '1111111' ||
            $this->registrationsc == '2222222' ||
            $this->registrationsc == '3333333' ||
            $this->registrationsc == '4444444' ||
            $this->registrationsc == '5555555' ||
            $this->registrationsc == '6666666' ||
            $this->registrationsc == '7777777' ||
            $this->registrationsc == '8888888' ||
            $this->registrationsc == '9999999'
        ) {
            throw new \InvalidArgumentException('Invalid Registration');
            // Calculate the verification digit
        }         
        // else {
        //     for ($t = 9; $t < 11; $t++) {
        //         for ($d = 0, $c = 0; $c < $t; $c++) {
        //             $d += intval($this->registrationsc[$c]) * (($t + 1) - $c);
        //         }
        //         $d = ((10 * $d) % 11) % 10;
        //         if (intval($this->registrationsc[$c]) !== $d) {
        //             throw new \InvalidArgumentException('Invalid Registration');
        //         }
        //     }
        // }
    }
}
