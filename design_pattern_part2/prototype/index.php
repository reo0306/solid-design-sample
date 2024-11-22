<?php

abstract class ItemPrototype
{
    public $name;
    private $review;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->review = [];
    }

    public function setRevew(string $review)
    {
        $this->review[] = $review;
    }

    public function createCopy(): ItemPrototype
    {
        return $this;
    }
}

class DeepCopyItem extends ItemPrototype
{
    public function __serialize(): array
    {
        return ['name' => $this->name];
    }

    public function __unserialize(array $data): void
    {
       $this->name = $data['name'];
    }

    public function createCopy(): ItemPrototype
    {
        return unserialize(serialize($this));
    }
}

class ShallowCopyItem extends ItemPrototype
{
    public function createCopy(): ItemPrototype
    {
        return clone $this;
    }
}

class ItemManager
{
    public $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function registerItem(string $key, ItemPrototype $item)
    {
        $this->items[$key] = $item;
    }

    public function create(string $key)
    {
        if (array_key_exists($key, $this->items)) {
            $item = $this->items[$key];
            return $item->createCopy();
        }

        throw new Exception("指定されたキーが存在しません");
    }
}

$mouse = new DeepCopyItem("マウス");
$keyboard = new ShallowCopyItem("キーボード");

$manager = new ItemManager();
$manager->registerItem("mouse", $mouse);
$manager->registerItem("keyboard", $keyboard);

$clonedMouse = $manager->create("mouse");
$clonedKeyboard = $manager->create("keyboard");

$clonedMouse->setRevew("Good");
$clonedKeyboard->setRevew("SoSo!");

print_r("mouse(original):" . PHP_EOL);
print_r($mouse);
print_r("mouse(copy):" . PHP_EOL);
print_r($clonedMouse);
print_r(PHP_EOL);
print_r("keyboard(original):" . PHP_EOL);
print_r($keyboard);
print_r("keyboard(copy):" . PHP_EOL);
print_r($clonedKeyboard);