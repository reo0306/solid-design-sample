<?php

interface LigthState
{
    public function switch(): LigthState;
}

class OffState implements LigthState
{
    public function switch(): LigthState
    {
        print_r("ライトを点灯します" . PHP_EOL);
        return new OnState();
    }
}

class OnState implements LigthState
{
    public function switch(): LigthState
    {
        print_r("ライトを消灯します" . PHP_EOL);
        return new OffState();
    }
}

class LightSwitch
{
    private $state;

    public function __construct()
    {
        $this->state = new OffState();
    }

    public function switch()
    {
        $this->state = $this->state->switch();
    }
}

$ligthSwitch = new LightSwitch();
$ligthSwitch->switch();
$ligthSwitch->switch();
$ligthSwitch->switch();