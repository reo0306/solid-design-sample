<?php

interface PaymentStrategy
{
    public function pay(int $amount);
}

class CreditCardPaymentStrategy implements PaymentStrategy
{
    public function pay(int $amount)
    {
        print_r("クレジットカードで{$amount}円の支払い" . PHP_EOL);
    }
}

class CashPaymentStrategy implements PaymentStrategy
{
    public function pay(int $amount)
    {
        print_r("現金で{$amount}円の支払い" . PHP_EOL);
    }
}

class ShoppingCart
{
    private $total;
    private $items;

    public function __construct()
    {
        $this->total = 0;
        $this->items = [];
    }

    public function addItem(string $item, int $price)
    {
        $this->total += $price;
        array_push($this->items, [$item, $price]);
    }

    public function pay(PaymentStrategy $paymentStrategy)
    {
        $paymentStrategy->pay($this->total);
    }
}

$cart = new ShoppingCart();
$cart->addItem("item1", 500);
$cart->addItem("item2", 1000);

$paymentStrategy1 = new CreditCardPaymentStrategy();
$cart->pay($paymentStrategy1);

$paymentStrategy2 = new CashPaymentStrategy();
$cart->pay($paymentStrategy2);