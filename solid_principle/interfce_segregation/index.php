<?php

abstract class Venhicle
{
    public function __construct(
        public readonly string $name,
        public readonly string $color,
    )
    {}
}

interface Movable
{
    public function start(): void;
}

interface Flyable
{
    public function fly(): void;
}

class Airplane extends Venhicle implements Movable, Flyable
{
    public function __construct(
        public readonly string $name,
        public readonly string $color,
    )
    {}

    public function start(): void
    {
        print_r("start!" . PHP_EOL);
    }

    public function stop(): void
    {
        print_r("stop!" . PHP_EOL);
    }

    public function fly(): void
    {
        print_r("fly!" . PHP_EOL);
    }
}

class Car extends Venhicle implements Movable
{
    public function __construct(
        public readonly string $name,
        public readonly string $color,
    )
    {}

    public function start(): void
    {
        print_r("start!" . PHP_EOL);
    }

    public function stop(): void
    {
        print_r("stop!" . PHP_EOL);
    }
}

$v1 = new Airplane("AirBus", "White");
$v2 = new Car("Prius", "Black");

$v1->fly();
$v2->start();
