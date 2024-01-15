<?php

namespace Lumenpink\Typesbr;

interface TypesbrInterface
{
    public function __construct(string $value);
    public function __toString(): string;
    public function digits(): string;
    public function formatted(): string;
    public function type(): string;
}
