<?php

class File
{
    private $name;

    public function __construct(string $name)
    {
       $this->name = $name; 
    }

    public function open()
    {
        print_r("{$this->name}が開かれました" . PHP_EOL);
    }

    public function compress()
    {
        print_r("{$this->name}が圧縮されました" . PHP_EOL);
    }

    public function close()
    {
        print_r("{$this->name}が閉じられました" . PHP_EOL);
    }
}

interface Command
{
    public function execute(): void;
}

class OpenCommand implements Command
{
    private $file;

    public function __construct(File $file)
    {
       $this->file = $file; 
    }

    public function execute(): void
    {
        $this->file->open();
    }
}

class CompressCommand implements Command
{
    private $file;

    public function __construct(File $file)
    {
       $this->file = $file; 
    }

    public function execute(): void
    {
        $this->file->compress();
    }
}

class CloseCommand implements Command
{
    private $file;

    public function __construct(File $file)
    {
       $this->file = $file; 
    }

    public function execute(): void
    {
        $this->file->close();
    }
}

class Queue
{
    private $commands;

    public function __construct()
    {
        $this->commands = [];
    }

    public function addCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeCommand(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}

$file = new File("command.php");
$queue = new Queue();
$queue->addCommand(new OpenCommand($file));
$queue->addCommand(new CompressCommand($file));
$queue->addCommand(new CloseCommand($file));

$queue->executeCommand();