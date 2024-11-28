<?php

use PSpell\Config;

class Context
{
    public $expression;
    public $date;

    public function __construct(string $expression , $date)
    {
       $this->validate($expression);
       $this->expression = $expression;
       $this->date = $date;
    }

    public function validate(string $expression)
    {
        //if (mb_strlen($expression) != 10 || !strpos($expression, 'YYYY/MM/DD')) {
        if (mb_strlen($expression) != 10) {
            throw new Exception("expressionが不正です。");
        }
    }
}

interface AbstractExpression
{
    public function interpret(Context $context);
}

class YearExpression implements AbstractExpression
{
    private $child;

    public function __construct()
    {
        $this->child = null;        
    }

    public function setChild(AbstractExpression $child)
    {
        $this->child = $child;
    }

    public function interpret(Context $context)
    {
        $expression = $context->expression;
        $year = date('Y', strtotime($context->date));
        $context->expression = str_replace('YYYY', $year, $expression);

        if ($this->child) {
            $this->child->interpret($context);
        }

        return $context;
    }
}

class MonthExpression implements AbstractExpression
{
    private $child;

    public function __construct()
    {
        $this->child = null;        
    }

    public function setChild(AbstractExpression $child)
    {
        $this->child = $child;
    }

    public function interpret(Context $context)
    {
        $expression = $context->expression;
        $month = date('m', strtotime($context->date));
        $context->expression = str_replace('MM', $month, $expression);

        if ($this->child) {
            $this->child->interpret($context);
        }

        return $context;
    }
}

class DayExpression implements AbstractExpression
{
    private $child;

    public function __construct()
    {
        $this->child = null;        
    }

    public function setChild(AbstractExpression $child)
    {
        $this->child = $child;
    }

    public function interpret(Context $context)
    {
        $expression = $context->expression;
        $day = date('d', strtotime($context->date));
        $context->expression = str_replace('DD', $day, $expression);

        if ($this->child) {
            $this->child->interpret($context);
        }

        return $context;
    }
}

$nowDate = date('Y/m/d', strtotime('now'));
$expression = "YYYY/MM/DD";

$context= new Context($expression, $nowDate);

$yearExpression = new YearExpression();
$monthExpression = new MonthExpression();
$dayExpression = new DayExpression();

$monthExpression->setChild($dayExpression);
$yearExpression->setChild($monthExpression);

$result = $yearExpression->interpret($context);

print_r(date('%m/%d/%Y', strtotime($nowDate)));
print_r(PHP_EOL);
print_r($result->expression);
print_r(PHP_EOL);