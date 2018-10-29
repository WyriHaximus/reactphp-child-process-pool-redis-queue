<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\ChildProcess\Pool\Queue;

use ApiClients\Tools\TestUtilities\TestCase;
use WyriHaximus\CpuCoreDetector\Resolver;
use WyriHaximus\React\ChildProcess\Pool\Queue\Redis;

final class RedisTest extends TestCase
{
    use QueueTestTrait;

    public function setUp()
    {
        parent::setUp();
        Resolver::reset();
    }

    public function tearDown()
    {
        parent::tearDown();
        Resolver::reset();
    }

    protected function getQueue()
    {
        return new Redis(new FakeRedis(), 'pool:queue');
    }
}
