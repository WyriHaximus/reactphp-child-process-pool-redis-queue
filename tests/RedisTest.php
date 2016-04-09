<?php

namespace WyriHaximus\React\Tests\ChildProcess\Pool\Queue;

use WyriHaximus\React\ChildProcess\Pool\Queue\Redis;
use WyriHaximus\React\Tests\ChildProcess\Pool\TestCase;

class RedisTest extends TestCase
{
    use QueueTestTrait;

    protected function getQueue()
    {
        return new Redis(new FakeRedis(), 'pool:queue');
    }
}
