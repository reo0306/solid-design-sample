<?php

interface Button
{
    public function press();
}

interface CheckBox
{
    public function switch();
}

interface GUIFactory
{
    public function createButton(): Button;

    public function createCheckBox(): CheckBox;
}

class WindowButton implements Button
{
    public function press()
    {
        print_r("Windowsのボタンが押されました" . PHP_EOL);
    }
}

class WindowCheckBox implements CheckBox
{
    public function switch()
    {
        print_r("Windowsのチェックボックスが切り替えられました" . PHP_EOL);
    }
}

class WindowsGUIFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new WindowButton();
    }

    public function createCheckBox(): CheckBox
    {
        return new WindowCheckBox();
    }
}

class MacButton implements Button
{
    public function press()
    {
        print_r("Macのボタンが押されました" . PHP_EOL);
    }
}

class MacCheckBox implements CheckBox
{
    public function switch()
    {
        print_r("Macのチェックボックスが切り替えられました" . PHP_EOL);
    }
}

class MacGUIFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new MacButton();
    }

    public function createCheckBox(): CheckBox
    {
        return new MacCheckBox();
    }
}

function run(GUIFactory $factory)
{
    $button = $factory->createButton();
    $checkbot = $factory->createCheckBox();
    $button->press();
    $checkbot->switch();
}

run(new WindowsGUIFactory());
run(new MacGUIFactory());