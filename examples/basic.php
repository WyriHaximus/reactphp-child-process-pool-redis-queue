<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Clue\React\Redis\Client;
use Clue\React\Redis\Factory;
use React\EventLoop\Factory as LoopFactory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Factory as MessageFactory;
use WyriHaximus\React\ChildProcess\Pool\Queue\Redis;

$loop = LoopFactory::create();
$factory = new Factory($loop);
$factory->createClient()->then(
    function (Client $client) {
        $queue = new Redis($client, 'pool:queue');
        echo 'Count: ', $queue->count(), PHP_EOL;
        $queue->enqueue(MessageFactory::rpc('a', ['b']))->then(function () use ($queue) {
            echo 'Count: ', $queue->count(), PHP_EOL;
            return $queue->dequeue();
        })->always(function () use ($queue, $client) {
            echo 'Count: ', $queue->count(), PHP_EOL;
            $client->close();
        });
    },
    function (Exception $e) {
        echo $e->getMessage(), PHP_EOL;
    }
);

$loop->run();
