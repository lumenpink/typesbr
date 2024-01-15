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
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Cpf('');
});
it('should throw an exception if the CPF is invalid', function () {
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Cpf('00000000192');
});
