<?php

namespace Lumenpink\Typesbr\Test;

use Lumenpink\Typesbr\Registrationsc;

it('shoud not validate an invalid Registration', function () {
    $this->expectException(\InvalidArgumentException::class);
    new Registrationsc('0000000');
});

it('should validate a valid Registration', function () {
    $this->expect(
        new Registrationsc('9000001')
    )->toBeInstanceOf(Registrationsc::class);
});

it('should accept a Registration with mask', function () {
    $cpf = new Registrationsc('900000-1');
    $this->expect(strval($cpf))->toBe('9000001');
});

it('should accept the Registration without the leading zeroes', function () {
    $cpf = new Registrationsc('1');
    $this->expect(strval($cpf))->toBe('0000001');
});
it('should accept the Registration with the wrong mask and letters', function () {
    $cpf = new Registrationsc('90.0.0.peq.00.-1');
    $this->expect(strval($cpf))->toBe('9000001');
});
it('shoult get the Registration digits only', function () {
    $cpf = new Registrationsc('9000001');
    $this->expect($cpf->digits())->toBe('9000001');
});
it('shoult format the Registration', function () {
    $cpf = new Registrationsc('9000001');
    $this->expect($cpf->formatted())->toBe('900.000-1');
});
it('should throw an exception if the Registration is empty', function () {
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Registrationsc('');
});
it('should throw an exception if the Registration is invalid', function () {
    $this->expectException(\InvalidArgumentException::class);
    $cpf = new Registrationsc('0000000');
});
