<?php

interface Mediator
{
    public function registerUser(User $user);

    public function sendMessage(string $msg, User $sendUser);
}

class ChatRoom implements Mediator
{
    private $members;

    public function __construct()
    {
        $this->members = [];
    }

    public function registerUser(User $user)
    {
        $this->members[] = $user;
    }

    public function sendMessage(string $msg, User $sendUser)
    {
        foreach($this->members as $member) {
            if ($member != $sendUser) {
               $member->receive($msg);
            }
        }
    }
}

abstract class User
{
    protected $mediator;
    protected $name;

    public function __construct(Mediator $mediator, string $name)
    {
        $this->mediator = $mediator;
        $this->name = $name;
    }

    public function send(string $msg)
    {}

    public function receive(string $msg)
    {}
}

class ChatUser extends User
{
    public function __construct(Mediator $mediator, string $name)
    {
       parent::__construct($mediator, $name);
    }

    public function send(string $msg)
    {
        print_r("{$this->name} -> メッセージ送信" . PHP_EOL);

        $this->mediator->sendMessage("{$msg} from {$this->name}", $this);
    }

    public function receive(string $msg)
    {
        print_r("{$this->name} -> メッセージ受信: {$msg}" . PHP_EOL);
    }
}

$chatRoom = new ChatRoom();

$yamada = new ChatUser($chatRoom, "yamada");
$suzuki = new ChatUser($chatRoom, "suzuki");
$tanaka = new ChatUser($chatRoom, "tanaka");

$chatRoom->registerUser($yamada);
$chatRoom->registerUser($suzuki);
$chatRoom->registerUser($tanaka);

$yamada->send("こんにちは");
$tanaka->send("こんばんわ");