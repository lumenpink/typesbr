<?php

namespace Lumenpink\Typesbr\Test;

use Lumenpink\Typesbr\Registrationsc;

it('shoud not validate an invalid Registration', function () {
    new Registrationsc('0000000');
})->throws(\InvalidArgumentException::class, 'Invalid Registration');

it('should validate a valid Registration', function () {
    $this->expect(
        new Registrationsc('9000001')
    )->toBeInstanceOf(Registrationsc::class);
});

it('should return CNPJ type name', function () {
    $this->expect(
        (new Registrationsc('9000001'))->type()
    )->toBe('registrationsc');
});

it('should accept a Registration with mask', function () {
    $registrationsc = new Registrationsc('900000-1');
    $this->expect(strval($registrationsc))->toBe('9000001');
});

it('should accept the Registration without the leading zeroes', function () {
    $registrationsc = new Registrationsc('1');
    $this->expect(strval($registrationsc))->toBe('0000001');
});

it('should accept the Registration with the wrong mask and letters', function () {
    $registrationsc = new Registrationsc('90.0.0.peq.00.-1');
    $this->expect(strval($registrationsc))->toBe('9000001');
});

it('should get the Registration digits only', function () {
    $registrationsc = new Registrationsc('9000001');
    $this->expect($registrationsc->digits())->toBe('9000001');
});

it('should not accept more than 7 digits', function () {
    $registrationsc = new Registrationsc('000000000');
})->throws(\InvalidArgumentException::class, 'Registration SC must have 7 digits');

it('should format the Registration', function () {
    $registrationsc = new Registrationsc('9000001');
    $this->expect($registrationsc->formatted())->toBe('900.000-1');
});

it('should throw an exception if the Registration is empty', function () {
    $registrationsc = new Registrationsc('');
})->throws(\InvalidArgumentException::class, 'Registration SC cannot be empty');

it('should throw an exception if the Registration is invalid', function () {
    $registrationsc = new Registrationsc('0000000');
})->throws(\InvalidArgumentException::class, 'Invalid Registration');
