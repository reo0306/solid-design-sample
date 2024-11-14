<?php

interface Shape
{
    public function getArea() :int;
}

class Rectangle implements Shape
{
    public function __construct(
        public readonly int $width,
        public readonly int $height,
    )
    {}

    public function getArea(): int
    {
        return $this->width * $this->height;     
    } 
}

class Square implements Shape
{
    public function __construct(
        public readonly int $length,
    )
    {}

    public function getArea(): int
    {
        return $this->length ** 2;
    }
}

function f(Shape $shape)
{
    print_r($shape->getArea() . PHP_EOL);
}

$r1 = new Rectangle(3, 4);
f($r1);

$r2 = new Square(3);
f($r2);
