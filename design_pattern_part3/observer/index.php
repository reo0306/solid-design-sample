<?php

interface Observer
{
    public function update(string $name);
}

class StoreObserver implements Observer
{
    public function update(string $name)
    {
        print_r("{$name}が入荷されました。仕入れが可能です" . PHP_EOL);
    }
}

class PersonalObserver implements Observer
{
    public function update(string $name)
    {
        print_r("{$name}が入荷されました。購入が可能です" . PHP_EOL);
    }
}

abstract class ItemSubject
{
    private $name;
    private $observers;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->observers = [];
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        unset($this->observers[$observer]);
    }

    public function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this->name);
        }
    }

    public function restock() {}
}

class TVGameSubject extends ItemSubject
{
    private $inStock;
    public function __construct(string $name)
    {
       parent::__construct($name);
        $this->inStock = false;
    }

    public function restock()
    {
        print_r("TVゲームの入荷" . PHP_EOL);
        $this->inStock = true;
        $this->notify();
    }
}

$store = new StoreObserver();
$person = new PersonalObserver();
$tvGame = new TVGameSubject("New RPG Game");

$tvGame->attach($store);
$tvGame->attach($person);
$tvGame->restock();