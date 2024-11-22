<?php

class Computer
{
    public $type;
    public $cpu;
    public $ram;

    public function __construct()
    {
    }
}

interface ComputerBuilder
{
    public function addCpu(string $cpu);

    public function addRam(int $ram);
}

class DescktopBuilder implements ComputerBuilder
{
    private $computer;

    public function __construct()
    {
        $this->computer = new Computer();
        $this->computer->type = "Desktop";
    }

    public function addCpu(string $cpu)
    {
        $this->computer->cpu = $cpu;
    }

    public function addRam(int $ram)
    {
        $this->computer->ram = $ram;
    }

    public function getResult(): Computer
    {
        return $this->computer;
    }
}


class LaptopBuilder implements ComputerBuilder
{
    private $computer;

    public function __construct()
    {
        $this->computer = new Computer();
        $this->computer->type = "Laptop";
    }

    public function addCpu(string $cpu)
    {
        $this->computer->cpu = $cpu;
    }

    public function addRam(int $ram)
    {
        $this->computer->ram = $ram;
    }

    public function getResult(): Computer
    {
        return $this->computer;
    }
}

class Director
{
    private $builder;

    public function __construct(ComputerBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function construct()
    {
        $this->builder->addCpu("Core i5");
        $this->builder->addRam(16);
    }

    public function highSpecConstruct()
    {
        $this->builder->addCpu("M2");
        $this->builder->addRam(64);
    }
}

$desktopBuilder = new DescktopBuilder();
$desktopDirector = new Director($desktopBuilder);
$desktopDirector->construct();
$desktopComputer = $desktopBuilder->getResult();
print_r($desktopComputer);
print_r(PHP_EOL);

$laptopBuilder = new LaptopBuilder();
$laptopDirector = new Director($laptopBuilder);
$laptopDirector->highSpecConstruct();
$laptopComputer = $laptopBuilder->getResult();
print_r($laptopComputer);
print_r(PHP_EOL);