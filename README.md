# reactphp-child-process-pool-redis-queue

[![Linux Build Status](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-redis-queue.png)](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-redis-queue)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-child-process-pool-redis-queue/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-child-process-pool-redis-queue)
[![Total Downloads](https://poser.pugx.org/wyrihaximus/react-child-process-pool-redis-queue/downloads.png)](https://packagist.org/packages/wyrihaximus/react-child-process-pool-redis-queue)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/react-child-process-pool-redis-queue/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-child-process-pool-redis-queue/?branch=master)
[![License](https://poser.pugx.org/wyrihaximus/react-child-process-pool-redis-queue/license.png)](https://packagist.org/packages/wyrihaximus/react-child-process-pool-redis-queue)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-child-process-pool-redis-queue/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-child-process-pool-redis-queue)

## Installation ##

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `~`.

```
composer require wyrihaximus/react-child-process-pool-redis-queue
```

## Usage ##

```php
$loop = LoopFactory::create();
$factory = new Factory($loop);
$factory->createClient()->then(
    function (Client $client) {
        Flexible::createFromClass('WyriHaximus\React\ChildProcess\Messenger\ReturnChild', $loop, [
            Options::QUEUE => new Redis($client, 'pool:queue'),
        ]);
    }
);
```

## License ##

Copyright 2016 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
