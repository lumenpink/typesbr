<?php

namespace Lumenpink\Typesbr\Test;

use Lumenpink\Typesbr\Cpf;

it('shoud not validate an invalid CPF', function () {
    $this->expectException(\InvalidArgumentException::class);
    new Cpf('00000000192');
});

it('should validate a valid CPF', function () {
    $this->expect(
        new Cpf('00000000191')
    )->toBeInstanceOf(Cpf::class);
});

it('should return CNPJ type name', function () {
    $this->expect(
        (new Cpf('00000000191'))->type()
    )->toBe('cpf');
});

it('should accept a CPF with mask', function () {
    $cpf = new Cpf('000.000.001-91');
    $this->expect(strval($cpf))->toBe('00000000191');
});

it('should accept the CPF without the leading zeroes', function () {
    $cpf = new Cpf('191');
    $this->expect(strval($cpf))->toBe('00000000191');
});
it('should accept the CPF with the wrong mask and letters', function () {
    $cpf = new Cpf('00.0.0.peq.0.1-91');
    $this->expect(strval($cpf))->toBe('00000000191');
});
it('shoult get the CPF digits only', function () {
    $cpf = new Cpf('00000000191');
    $this->expect($cpf->digits())->toBe('00000000191');
});
it('shoult format the CPF', function () {
    $cpf = new Cpf('00000000191');
    $this->expect($cpf->formatted())->toBe('000.000.001-91');
});
it('should throw an exception if the CPF is empty', function () {
    $cpf = new Cpf('');
})->throws(\InvalidArgumentException::class, 'CPF cannot be empty');
it('should throw an exception if the CPF is invalid', function () {
    $cpf = new Cpf('00000000192');
})->throws(\InvalidArgumentException::class, 'Invalid CPF');
it('should throw an exception if the CPF is all the same digit', function () {
    $cpf = new Cpf('00000000000');
})->throws(\InvalidArgumentException::class, 'CPF cannot repeat same digit');

it('should throw an exception if the CPF have more than 11 digits', function () {
    $cpf = new Cpf('000000000000');
})->throws(\InvalidArgumentException::class, 'CPF must have 11 digits');
