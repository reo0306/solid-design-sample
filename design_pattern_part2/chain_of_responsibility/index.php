<?php

abstract class ValidationHandler
{
    private $nextHandler;

    public function __construct()
    {}

    public function setHandler(ValidationHandler $handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    protected function execValidation(string $input): bool
    {
        return true;
    }

    protected function getErrorMessage()
    {
        return;
    }

    public function validate(string $input): bool
    {
        $result = $this->execValidation($input);

        if (!$result) {
            $this->getErrorMessage();
            return false;
        } elseif ($this->nextHandler) {
           return $this->nextHandler->validate($input) ;
        } else {
            return true;
        }
    }
}

class NotNullValidationHandler extends ValidationHandler
{
    protected function execValidation(string $input): bool
    {
        $result = false;

        if ($input) {
            $result = true;
        }

        print_r("NotNullValidationの結果: {$result}" . PHP_EOL);

        return $result;
    }

    protected function getErrorMessage()
    {
        print_r("何も入力されていません。" . PHP_EOL);
    }

    /*protected function setHandler(ValidationHandler $handler)
    {
        parent::setHandler(($handler));
    }*/
}

class AlphabetValidationHandler extends ValidationHandler
{
    protected function execValidation(string $input): bool
    {
        $result = false;

        if ($input) {
            $result = true;
        }

        print_r("AlphabetValidationの結果: {$result}" . PHP_EOL);
        return $result;
    }

    protected function getErrorMessage()
    {
        print_r("半角英数字で入力してください。" . PHP_EOL);
    }

    /*protected function setHandler(ValidationHandler $handler)
    {
        parent::setHandler(($handler));
    }*/
}

class MinLengthValidationHandler extends ValidationHandler
{
    protected function execValidation(string $input): bool
    {
        $result = false;

        if (mb_strlen($input) >= 8) {
            $result = true;
        }

        print_r("MinLengthValidationの結果: {$result}" . PHP_EOL);

        return $result;
    }

    protected function getErrorMessage()
    {
        print_r("8文字以上で入力してください。" . PHP_EOL);
    }

    /*protected function setHandler(ValidationHandler $handler)
    {
        parent::setHandler(($handler));
    }*/
}

$notNullHandler = new NotNullValidationHandler();
$alphabetHandler = new AlphabetValidationHandler();
$minLengthHadler = new MinLengthValidationHandler();

$notNullHandler->setHandler($alphabetHandler)->setHandler($minLengthHadler);

$result = $notNullHandler->validate("helloworld");

if ($result) {
    print_r("すべてのバリデーションに通過しました" . PHP_EOL);
}
