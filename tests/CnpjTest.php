<?php

namespace Lumenpink\Typesbr\Test;

use Lumenpink\Typesbr\Cnpj;

it('shoud not validate an invalid CNPJ', function () {
    new Cnpj('00000000000192');
})->throws(\InvalidArgumentException::class, 'Invalid CNPJ');

it('should validate a valid CNPJ', function () {
    $this->expect(
        new Cnpj('00000000000191')
    )->toBeInstanceOf(Cnpj::class);
});

it('should return CNPJ type name', function () {
    $this->expect(
        (new Cnpj('00000000000191'))->type()
    )->toBe('cnpj');
});

it('should accept a CNPJ with mask', function () {
    $cpf = new Cnpj('00.000.000/0001-91');
    $this->expect(strval($cpf))->toBe('00000000000191');
});

it('should accept the CNPJ without the leading zeroes', function () {
    $cpf = new Cnpj('191');
    $this->expect(strval($cpf))->toBe('00000000000191');
});
it('should accept the CNPJ with the wrong mask and letters', function () {
    $cpf = new Cnpj('00.00.00.peq.00.1-91');
    $this->expect(strval($cpf))->toBe('00000000000191');
});
it('shoult get the CNPJ digits only', function () {
    $cpf = new Cnpj('00000000000191');
    $this->expect($cpf->digits())->toBe('00000000000191');
});

it('should not accept more than 14 digits', function () {
    $cpf = new Cnpj('000000000000191');
})->throws(\InvalidArgumentException::class, 'CNPJ must have 14 digits');

it('shoult format the CNPJ', function () {
    $cpf = new Cnpj('00000000000191');
    $this->expect($cpf->formatted())->toBe('00.000.000/0001-91');
});
it('should throw an exception if the CNPJ is empty', function () {
    $cpf = new Cnpj('');
})->throws(\InvalidArgumentException::class, 'CNPJ cannot be empty');
it('should throw an exception if the CNPJ is invalid', function () {
    $cpf = new Cnpj('00000000000192');
})->throws(\InvalidArgumentException::class, 'Invalid CNPJ');

it('should throw an exception if the CNPJ is all the same digit', function () {
    $cpf = new Cnpj('00000000000000');
})->throws(\InvalidArgumentException::class, 'CNPJ cannot repeat same digit');
