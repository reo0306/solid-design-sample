<?php

interface Component
{
    public function getLogMessage(string $msg): string;
}

class Logger implements Component
{
    public function getLogMessage(string $msg): string
    {
        return $msg;
    }
}

abstract class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function getLogMessage(string $msg): string
    {
        return "";
    }
}

class TimestampDecorator extends Decorator
{
    public function __construct(Component $component)
    {
       parent::__construct($component) ;
    }

    public function getLogMessage(string $msg): string
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        return $this->component->getLogMessage("{$now} {$msg}");
    }
}

class LogLevelDecorator extends Decorator
{
    private $logLevel;

    public function __construct(Component $component, string $logLevel)
    {
       parent::__construct($component);
       $this->logLevel = $logLevel;
    }

    public function getLogMessage(string $msg): string
    {
        return $this->component->getLogMessage("{$this->logLevel} {$msg}");
    }

}

$logger = new Logger();
$logLevelLogger = new LogLeveldecorator($logger, "INFO");
$timestampLogger = new TimestampDecorator($logLevelLogger);

print_r($logger->getLogMessage("Design Pattern!"));
print_r(PHP_EOL);
print_r($logLevelLogger->getLogMessage("Design Pattern!"));
print_r(PHP_EOL);
print_r($timestampLogger->getLogMessage("Design Pattern!"));
print_r(PHP_EOL);