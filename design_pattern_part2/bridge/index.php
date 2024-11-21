<?php

interface MessageApp
{
    public function send();
}

class LINE implements MessageApp
{
    public function send()
    {
        print_r("LINEでメッセージを送信しました" . PHP_EOL);
    }
}

class Twitter implements MessageApp
{
    public function send()
    {
        print_r("Twitterでメッセージを送信しました" . PHP_EOL);
    }
}

class Facebook implements MessageApp
{
    public function send()
    {
        print_r("Facebookでメッセージを送信しました" . PHP_EOL);
    }
}

abstract class OS
{
    protected $app;

    public function __construct()
    {}

    public function setApp(MessageApp $app)
    {
        $this->app = $app;
    }

    public function sendMessage()
    {}
}

class IOS extends OS
{
    public function sendMessage()
    {
        print_r("iOSでメッセージ送信" . PHP_EOL);

        if ($this->app) {
            $this->app->send();
        } else {
            throw new Exception("アプリが指定されていません");
        }
    }
}

class Android extends OS
{
    public function sendMessage()
    {
        print_r("Androidでメッセージ送信" . PHP_EOL);

        if ($this->app) {
            $this->app->send();
        } else {
            throw new Exception("アプリが指定されていません");
        }
    }
}

$line = new LINE();
$twitter = new Twitter();
$facebook = new Facebook();

$ios = new IOS();
$android = new Android();

$ios->setApp($line);
$ios->sendMessage();

$android->setApp($facebook);
$android->sendMessage();