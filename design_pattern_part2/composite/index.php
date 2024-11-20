<?php

abstract class Entry
{
    protected $size;

    public function __construct(
        public readonly string $name
    )
    {}

    public function getSize(): int
    {
        return 0;
    }

    public function remove(): void
    {}
}

class File extends Entry
{
    public function __construct(string $name, int $size)
    {
       parent::__construct($name);
       $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function remove(): void
    {
        print_r("{$this->name}を削除しました" . PHP_EOL);
    }
}

class DirectoryEx extends Entry
{
    private $children;

    public function __construct(string $name)
    {
       parent::__construct($name);
       $this->children = [];
    }

    public function getSize(): int
    {
        $size = 0;

        foreach ($this->children as $child) {
            $size += $child->getSize();
        }

        return $size;
    }

    public function remove(): void
    {
        foreach ($this->children as $child) {
            $child->remove();
        }

        print_r("{$this->name}を削除しました" . PHP_EOL);
    }

    public function add(Entry $child)
    {
        array_push($this->children, $child);
    }
}

function client(Entry $entry)
{
    print_r($entry->name . PHP_EOL);
    print_r($entry->getSize() . PHP_EOL);
    $entry->remove();
}


$dir1 = new DirectoryEx("design_pattern");
$dir2 = new DirectoryEx("composite");
$file1 = new File("compsite.py", 100);
$file2 = new File("practice.py", 150);

$dir2->add($file1);
$dir2->add($file2);
$dir1->add($dir2);

client($dir1);