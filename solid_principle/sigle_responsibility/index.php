<?php

class EmployeeData
{
    public function __construct(
        public readonly string $name,
        public readonly string $department
    )
    {}
}

class PayCalculator
{
    private function getRegularHours() :void
    {
        print_r("給与計算専用の労働時間の計算ロジック" . PHP_EOL);
    }

    public function calculatePay(EmployeeData $empoyeeData) :void
    {
        $this->getRegularHours();
        print_r("{$empoyeeData->name}の給与を計算しました" . PHP_EOL);
    }
}

class HourReporter
{
    private function getRegularHours() :void
    {
        print_r("労働時間レポート専用の労働時間の計算ロジック_V2" . PHP_EOL);
    }

    public function repotHours(EmployeeData $empoyeeData) :void
    {
        $this->getRegularHours();
        print_r("{$empoyeeData->name}の労働時間を計算しました" . PHP_EOL);
    }
}

class EmployeeRepository
{
    public function save() {
    }
}

$employeeData = new EmployeeData("Suzuki", "develop");
$payCalculator = new PayCalculator();
$hourReporter = new HourReporter();

print_r("経理部門" . PHP_EOL);
$payCalculator->calculatePay($employeeData);

print_r(PHP_EOL);

print_r("人事部門" . PHP_EOL);
$hourReporter->repotHours($employeeData);