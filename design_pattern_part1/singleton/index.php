<?php

class Logger
{
    public function output(string $content): void
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        print_r("{$now}: {$content}" . PHP_EOL);
    }
}

class Test {}

$test1 = new Test();
$test2 = new Test();
print_r("Test: ");
print_r($test1 == $test2);
print_r(PHP_EOL);

$logger1 = new Logger();
$logger2 = new Logger();
print_r("Singleton: ");
print_r($logger1 == $logger2);
print_r(PHP_EOL);

$logger1->output("logger1のログ");
$logger2->output("logger2のログ");
