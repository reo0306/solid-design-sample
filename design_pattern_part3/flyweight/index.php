<?php

class Stamp
{
    private $char;

    public function __construct(string $char)
    {
        $this->char = $char;
    }

    public function printChar()
    {
        print_r($this->char . PHP_EOL);
    }
}

class StampFactory
{
    private $pool;

    public function __construct()
    {
        $this->pool = [];
    }

    public function getStamp(string $char): Stamp
    {
        $stamp = $this->pool[$char];

        if ($stamp) {
            return $stamp;
        }

        $newStamp = new Stamp($char);
        $this->pool[$char] = $newStamp;

        return $newStamp;
    }

    public function getPool()
    {
        return $this->pool;
    }
}

$factroy = new StampFactory();
$stamp1 = $factroy->getStamp("し");
$stamp2 = $factroy->getStamp("ん");
$stamp3 = $factroy->getStamp("ぶ");
$stamp4 = $factroy->getStamp("ん");
$stamp5 = $factroy->getStamp("し");

$stamp1->printChar();
$stamp2->printChar();
$stamp3->printChar();
$stamp4->printChar();
$stamp5->printChar();

print_r($factroy->getPool());