<?php
class Product
{
    public function getProduct(string $name)
    {
        print_r("{$name}を取得しました" . PHP_EOL);
    }
}

class Payment
{
    public function makePayment(string $name)
    {
        print_r("{$name}の支払いが完了しました" . PHP_EOL);
    }
}

class Invoice
{
    public function sendInvoice(string $name)
    {
        print_r("{$name}の請求が送信されました" . PHP_EOL);
    }
}

class Order
{
    public function placeOrder(string $name)
    {
        print_r("注文開始" . PHP_EOL);

        $product = new Product();
        $product->getProduct($name);

        $payment = new Payment();
        $payment->makePayment($name);

        $invoice = new Invoice();
        $invoice->sendInvoice($name);

        print_r("注文が正常に完了しました" . PHP_EOL);
    }
}

$name = "デザインパターン本";
$order = new Order();
$order->placeOrder($name);