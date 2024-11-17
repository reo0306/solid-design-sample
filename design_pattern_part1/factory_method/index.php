<?php

interface CreditCard
{
    //public function __construct(public readonly string $owner);

    public function getCardType(): string;

    public function getAnnualCharge(): int;
}

class Platinum implements CreditCard
{
    public function getCardType(): string
    {
        return "Platinum";
    }

    public function getAnnualCharge(): int
    {
        return 30000;
    }
}

class Gold implements CreditCard
{
    public function getCardType(): string
    {
        return "Gold";
    }

    public function getAnnualCharge(): int
    {
        return 10000;
    }
}

abstract class CreditCardFactory
{
    public function createCreditCard(string $owner): CreditCard
    {
        return new CreditCard;
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
        $creditCardDatabase[] = $creditCard;
    }

    public function create(string $owner): CreditCard
    {
        $creditCard = $this->createCreditCard($owner);
        $this->registerCreditCard($creditCard);

        return $creditCard;
    }
}

$creditCardDatabase = [];

class PlatinumCreditCardFactory extends CreditCardFactory
{
    public function createCreditCard(string $owner): CreditCard
    {
        return new Platinum($owner);
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
        global $creditCardDatabase;
        $creditCardDatabase[] = $creditCard;
    }
}

class GoldCreditCardFactory extends CreditCardFactory
{
    public function createCreditCard(string $owner) :CreditCard
    {
        return new Gold($owner);
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
        global $creditCardDatabase;
        $creditCardDatabase[] = $creditCard;
    }
}

$platinumCreditCardFactory = new PlatinumCreditCardFactory();
$platinumCared = $platinumCreditCardFactory->create("Tanaka");
print_r($platinumCared->getCardType());

print_r(PHP_EOL);

$goldCreditCardFactory = new GoldCreditCardFactory();
$goldCared = $goldCreditCardFactory->create("Suzuki");
print_r($goldCared->getCardType());

print_r(PHP_EOL);

print_r($creditCardDatabase);
print_r(PHP_EOL);