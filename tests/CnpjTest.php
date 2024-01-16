<?php

namespace Lumenpink\Typesbr\Test;

use Lumenpink\Typesbr\Cnpj;

it('shoud not validate an invalid CNPJ', function () {
    $this->expectException(\InvalidArgumentException::class);
    new Cnpj('00000000000192');
});

it('should validate a valid CNPJ', function () {
    $this->expect(
        new Cnpj('00000000000191')
    )->toBeInstanceOf(Cnpj::class);
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
it('shoult format the CNPJ', function () {
    $cpf = new Cnpj('00000000000191');
    $this->expect($cpf->formatted())->toBe('00.000.000/0001-91');
});
it('should throw an exception if the CNPJ is empty', function () {
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Cnpj('');
});
it('should throw an exception if the CNPJ is invalid', function () {
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Cnpj('00000000000192');
});
