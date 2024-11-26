<?php

abstract class Entry
{
    private $code;
    private $name;

    public function __construct(string $code, string $name)
    {
       $this->code = $code;
       $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChildren()
    {
        return [];
    }

    public function accept(Visitor $visitor) {}
}

class Group extends Entry
{
    private $entries;

    public function __construct(string $code , string $name)
    {
        parent::__construct($code, $name);
        $this->entries = [];
    }

    public function add(Entry $entry)
    {
        $this->entries[] = $entry;
    }

    public function getChildren(): array
    {
        return $this->entries;
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visit($this);
    }
}

class Employee extends Entry
{
    public function __construct(string $code , string $name)
    {
        parent::__construct($code, $name);
    }

    public function getChildren(): array
    {
        return [];
    }

    public function accept(Visitor $visitor)
    {
        $visitor->visit($this);
    }
}

interface Visitor
{
    public function visit(Entry $entry);
}


class ListVisitor implements Visitor
{
    public function visit(Entry $entry)
    {
        if (get_class($entry) == "Group") {
            print_r("{$entry->getCode()}: {$entry->getName()}" . PHP_EOL);
        } else {
            print_r("    {$entry->getCode()}: {$entry->getName()}" . PHP_EOL);
        }

        foreach ($entry->getChildren() as $child) {
            $child->accept($this);
        }
    }
}

class CountVisitor implements Visitor
{
    private $groupCount;
    private $employeeCount;

    public function __construct()
    {
        $this->groupCount = 0;
        $this->employeeCount = 0;
    }

    public function getGroupCount(): int
    {
        return $this->groupCount;
    }

    public function getEmployeeCount(): int
    {
        return $this->employeeCount;
    }

    public function visit(Entry $entry)
    {
        if (get_class($entry) == "Group") {
            $this->groupCount += 1;
        } else {
            $this->employeeCount += 1;
        }

        foreach ($entry->getChildren() as $child) {
            $child->accept($this);
        }
    }
}

$rootEntry = new Group("01", "本社");
$rootEntry->add(new Employee("0101", "社長"));
$rootEntry->add(new Employee("0102", "副社長"));

$group1 = new Group("10", "神奈川支部");
$group1->add(new Employee("1001", "支部長"));

$group2 = new Group("11", "横浜営業所");
$group2->add(new Employee("1101", "営業部長"));
$group2->add(new Employee("1102", "yamada"));
$group2->add(new Employee("1103", "suzuki"));
$group2->add(new Employee("1104", "tanaka"));

$group1->add($group2);
$rootEntry->add($group1);

$listVisitor = new ListVisitor();
$countVisitor = new CountVisitor();

$rootEntry->accept($listVisitor);
$rootEntry->accept($countVisitor);

print_r("グループ数: {$countVisitor->getGroupCount()}" . PHP_EOL);
print_r("社員数: {$countVisitor->getEmployeeCount()}" . PHP_EOL);
