Zimbra SOAP API library Installation
====================================

## Requirement
* PHP 7.4.x or later,
* [Http Discovery](https://docs.php-http.org/en/latest/discovery.html) library for finding installed http clients and http message factories,
* [Serializer](https://jmsyst.com/libs/serializer) library for (de-)serializing XML,
* [PHP Enum](https://github.com/myclabs/php-enum) library,
* (optional) PHPUnit to run tests,

## Installation
The recommended installation method is using [Composer](https://getcomposer.org)
```bash
$ composer require zimbra-api/soap-api
```
or just add it to your `composer.json` file directly.
```javascript
{
    "require": {
        "zimbra-api/soap-api": "*"
    }
}
```

This package using [PSR-17: HTTP Factories](https://www.php-fig.org/psr/psr-17/), [PSR-18: HTTP Client](https://www.php-fig.org/psr/psr-18/) for creating SOAP messages & sending SOAP requests to Zimbra SOAP service.
Make sure to install package(s) providing ["http client implementation"](https://packagist.org/providers/psr/http-client-implementation) & ["http factory implementation"](https://packagist.org/providers/psr/http-factory-implementation).
The recommended package is [Guzzle](https://docs.guzzlephp.org) which provide both PSR-17 & PSR-18.
```bash
$ composer require guzzlehttp/guzzle
```

## Serializer Annotations & Metadata Caching
Install `symfony/cache` version v5.4.11
```bash
$ composer require symfony/cache:v5.4.11
```

Or install `doctrine/cache` version 1.13.0
```bash
$ composer require doctrine/cache:1.13.0
```

Set serializer builer cache dir

```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Common\Serializer\SerializerFactory;

SerializerFactory::setCacheDir($cacheDir);
```
