<?php

namespace WyriHaximus\React\Tests\ChildProcess\Pool\Queue;

use Clue\React\Redis\Client;
use Evenement\EventEmitterTrait;
use React\Promise\FulfilledPromise;

class FakeRedis implements Client
{
    use EventEmitterTrait;

    protected $queue = [];

    public function __call($name, $args)
    {
        switch ($name) {
            case 'lpush':
                array_push($this->queue, $args[1]);
                return new FulfilledPromise();
                break;
            case 'lpop':
                return new FulfilledPromise(array_shift($this->queue));
                break;
            case 'llen':
                return new FulfilledPromise(count($this->queue));
                break;
        }
    }

    public function isBusy()
    {
        // TODO: Implement isBusy() method.
    }

    public function end()
    {
        // TODO: Implement end() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }
}
