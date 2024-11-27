<?php

interface Memento
{
    public function getMemo(): string;
}

class ConcreteMemento implements Memento
{
    private $memo;
    private $date;

    public function __construct(string $memo)
    {
       $this->memo = $memo;
       $this->date = date('Y-m-d H:i:s', strtotime('now'));
    }

    public function getMemo(): string
    {
        return $this->memo;
    }
}

class Notepad
{
    private $memo;

    public function __construct(string $memo)
    {
        $this->memo = $memo;        
    }

    public function getMemo()
    {
        return $this->memo;
    }

    public function addMemo(string $memo)
    {
        $this->memo = $memo;
    }

    public function save(): Memento
    {
        print_r("メモを保存しました" . PHP_EOL);
        return new ConcreteMemento($this->getMemo());
    }

    public function restore(Memento $memento)
    {
        $this->addMemo($memento->getMemo());
    }
}

class Caretaker
{
    private $notepad;
    private $mementos;

    public function __construct(Notepad $notepad, array $mementos)
    {
       $this->notepad = $notepad;
       $this->mementos = $mementos;
    }

    public function backup()
    {
        $this->mementos[] = $this->notepad->save();
    }

    public function undo()
    {
        if (count($this->mementos) == 0) {
            print_r("スナップショットが存在しません" . PHP_EOL);
            return;
        }

        $memento = array_pop($this->mementos);
        $this->notepad->restore($memento);
    }

    public function showHistory()
    {
        foreach ($this->mementos as $memento) {
            var_dump($memento);
        }
    }
}

$notepad = new Notepad("first memo");
$caretaker = new Caretaker($notepad, []);
$caretaker->backup();

$notepad->addMemo("second memo");
$caretaker->backup();

$notepad->addMemo("third memo");
$caretaker->backup();
print_r($notepad->getMemo() . PHP_EOL);
$caretaker->showHistory();

print_r(PHP_EOL);

$caretaker->undo();
print_r($notepad->getMemo() . PHP_EOL);
$caretaker->undo();
print_r($notepad->getMemo() . PHP_EOL);
$caretaker->undo();
print_r($notepad->getMemo() . PHP_EOL);
$caretaker->undo();
print_r($notepad->getMemo() . PHP_EOL);
$caretaker->showHistory();



