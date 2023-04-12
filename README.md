Zimbra SOAP API library
=======================
This library is a simple Object Oriented wrapper for the Zimbra SOAP API.

## Requirement
* PHP 8.x
* [Http Discovery](https://docs.php-http.org/en/latest/discovery.html) library for finding installed http clients and http message factories,
* [Serializer](https://jmsyst.com/libs/serializer) library for (de-)serializing XML,
* (optional) PHPUnit to run tests,

## Installation
Via [Composer](https://getcomposer.org)
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

## Basic usage of admin api

```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Admin\AdminApi;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;

$api = new AdminApi('https://zimbra.server:7071/service/admin/soap');
$api->auth($username, $password);
$account = $api->getAccountInfo(new AccountSelector(AccountBy::NAME, $accountName));
```

From `$api` object, you can access to all Zimbra Admin API.

## Licensing
[BSD 3-Clause](LICENSE)

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.
