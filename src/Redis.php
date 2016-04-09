<?php

namespace WyriHaximus\React\ChildProcess\Pool\Queue;

use Clue\React\Redis\Client;
use React\Promise\PromiseInterface;
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
    }

    /**
     * @param Rpc $rpc
     */
    public function enqueue(Rpc $rpc)
    {
        $this->redis->lpush($this->key, serialize($rpc))->always(function () {
            $this->updatedLength();
        });
    }

    /**
     * @return PromiseInterface
     */
    public function dequeue()
    {
        return $this->redis->lpop($this->key)->always(function () {
            $this->updatedLength();
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
        $this->redis->llen($this->key)->then(function ($length) {
            $this->length = $length;
        });
    }
}
