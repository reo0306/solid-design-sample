<?php

class Patient
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }
}

interface IIterator
{
    public function hasNext(): bool;
    public function next();
}

interface Aggregate
{
    public function getIterator(): IIterator;
}

class WaitingRoom implements Aggregate
{
    private $patients;

    public function __construct()
    {
        $this->patients = [];
    }

    public function getPatients(): array
    {
        return $this->patients;
    }

    public function getCount(): int
    {
        return count($this->patients);
    }

    public function checkIn(Patient $patient): void
    {
        $this->patients[] = $patient;
    }

    public function getIterator(): IIterator
    {
        return new WaitingRoomIterator($this);
    }
}

class WaitingRoomIterator implements IIterator
{
    private $position;
    private $aggregate;

    public function __construct(WaitingRoom $aggregate)
    {
        $this->position = 0;
        $this->aggregate = $aggregate;        
    }

    public function hasNext(): bool
    {
        return $this->position < $this->aggregate->getCount();
    }

    public function next()
    {
        if (!$this->hasNext()) {
            print_r("患者がいません" . PHP_EOL);
            return;
        }

        $patient = $this->aggregate->getPatients()[$this->position];
        $this->position += 1;

        return $patient;
    }
}

$waitingRoom = new WaitingRoom();

$waitingRoom->checkIn(new Patient(1, "Yamamda"));
$waitingRoom->checkIn(new Patient(2, "Suzuki"));
$waitingRoom->checkIn(new Patient(3, "Tanaka"));

$iterator = $waitingRoom->getIterator();
print_r($iterator->next());
print_r($iterator->next());
print_r($iterator->next());
print_r($iterator->next());