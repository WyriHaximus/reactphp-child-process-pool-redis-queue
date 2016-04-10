<?php

namespace WyriHaximus\React\ChildProcess\Pool\Queue;

use Clue\React\Redis\Client;
use React\Promise\FulfilledPromise;
use React\Promise\PromiseInterface;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Factory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Rpc;
use WyriHaximus\React\ChildProcess\Pool\QueueInterface;

class Redis implements QueueInterface
{
    /**
     * @var Client
     */
    protected $redis;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var int
     */
    protected $length = 0;

    /**
     * Redis constructor.
     * @param Client $redis
     * @param string $key
     */
    public function __construct(Client $redis, $key)
    {
        $this->redis = $redis;
        $this->key = $key;
        $this->updatedLength();
    }

    /**
     * @param Rpc $rpc
     */
    public function enqueue(Rpc $rpc)
    {
        return $this->redis->lpush($this->key, json_encode($rpc))->always(function () {
            return $this->updatedLength();
        });
    }

    /**
     * @return PromiseInterface
     */
    public function dequeue()
    {
        return $this->redis->lpop($this->key)->then(function ($rpc) {
            return \React\Promise\resolve(Factory::fromLine($rpc, []));
        })->always(function () {
            return $this->updatedLength();
        });
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->length;
    }

    protected function updatedLength()
    {
        return $this->redis->llen($this->key)->then(function ($length) {
            $this->length = $length;
            return new FulfilledPromise();
        });
    }
}
