<?php

interface IEmployee
{
    public function getBonus(string $base) :int;
}

class JuniorEmployee implements IEmployee
{
    public function getBonus(string $base): int
    {
       return floor($base * 1.1);
    }
}

class MiddleEmployee implements IEmployee
{
    public function getBonus(string $base): int
    {
       return floor($base * 1.5);
    }
}

class SeniorEmployee implements IEmployee
{
    public function getBonus(string $base): int
    {
       return floor($base * 2);
    }
}

class ExpertEmployee implements IEmployee
{
    public function getBonus(string $base): int
    {
       return floor($base * 3);
    }
}

$emp1 = new JuniorEmployee("Yamada");
$emp2 = new MiddleEmployee("Suzuki");
$emp3 = new SeniorEmployee("Tanak");
$emp3 = new ExpertEmployee("Bob");

$base = 100;

print_r($emp1->getBonus($base) . PHP_EOL);
print_r($emp2->getBonus($base) . PHP_EOL);
print_r($emp3->getBonus($base) . PHP_EOL);
print_r($emp3->getBonus($base) . PHP_EOL);