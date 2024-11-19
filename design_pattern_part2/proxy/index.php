<?php

interface Server
{
    public function handle(string $userId);
}

class RealServer implements Server
{
    public function handle(string $userId)
    {
        print_r("{$userId}の処理を実行中。。。" . PHP_EOL);
    }
}

class Proxy implements Server
{
    public function __construct(
        public readonly Server $server,
    )
    {}

    protected function authorize(string $userId)
    {
        $authorizedUserId = ["1", "2", "3"];

        if (!in_array($userId, $authorizedUserId)) {
            throw new Exception("操作が許可されてません。");
        }
    }

    public function handle(string $userId)
    {
        $this->authorize($userId);

        print_r("処理を開始します" . PHP_EOL);
        
        $this->server->handle($userId);

        print_r("処理が終了しました" . PHP_EOL);
    }
}


$server = new RealServer();
$proxy = new Proxy($server);
$proxy->handle("2");
