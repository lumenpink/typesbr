<?php

namespace Lumenpink\Typesbr;

interface TypesbrInterface
{
    public function __construct(string $value);
    public function normalize();
    public function format();
    public function __toString(): string;
    public static function validate($value);
}
