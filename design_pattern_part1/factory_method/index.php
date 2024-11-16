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
    public function createCreditCard(string $owner)
    {
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
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
    public function createCreditCard(string $owner)
    {
        return new Platinum($owner);
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
        $creditCardDatabase[] = $creditCard;
    }
}

class GoldCreditCardFactory extends CreditCardFactory
{
    public function createCreditCard(string $owner)
    {
        return new Gold($owner);
    }

    public function registerCreditCard(CreditCard $creditCard)
    {
        $creditCardDatabase[] = $creditCard;
    }
}

$platinumCreditCardFactory = new PlatinumCreditCardFactory();
$platinumCared