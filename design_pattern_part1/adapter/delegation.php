<?php

interface Target
{
    public function getCsvData(): string;
}

class NewLibrary
{
    public function getJsonData(): array
    {
        return [
            [
                "data1" => "json_dataA",
                "data2" => "json_dataB",
            ],
            [
                "data1" => "json_dataC",
                "data2" => "json_dataD",
            ],
        ];
    }
}

class JsonToCsvAdapter implements Target
{
    public function __construct(
        public readonly NewLibrary $adapter,
    )
    {}

    public function getCsvData(): string
    {
        $jsonData = $this->adapter->getJsonData();

        $header = implode(",", array_keys($jsonData[0])) . PHP_EOL;

        $body = "";
        foreach ($jsonData as $val) {
            $body .= PHP_EOL . implode(",", $val);
        }

        return $header . $body;
    }
}

$adapter = new NewLibrary();
print_r("=== Adapterが提供するデータ ===" . PHP_EOL);
print_r($adapter->getJsonData());

print_r(PHP_EOL);

$adapter = new JsonToCsvAdapter($adapter);
print_r("=== Adapterが変換されたデータ ===" . PHP_EOL);
print_r($adapter->getCsvData());
print_r(PHP_EOL);
