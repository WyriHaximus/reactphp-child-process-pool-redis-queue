<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\ChildProcess\Pool\Queue;

use ApiClients\Tools\TestUtilities\TestCase;
use WyriHaximus\CpuCoreDetector\Resolver;
use WyriHaximus\React\ChildProcess\Pool\Queue\Redis;

/**
 * @internal
 */
final class RedisTest extends TestCase
{
    use QueueTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        Resolver::reset();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Resolver::reset();
    }

    protected function getQueue()
    {
        return new Redis(new FakeRedis(), 'pool:queue');
    }
}
