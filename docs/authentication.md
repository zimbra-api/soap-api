Authentication
==============

## Account Authentication
Authentication by account name
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Account\AccountApi;

$api = new AccountApi('https://zimbra.server/service/soap');
$response = $api->authByAccountName($accountName, $password);
$authToken = $response->getAuthToken();
```

Authentication by account id
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Account\AccountApi;

$api = new AccountApi('https://zimbra.server/service/soap');
$response = $api->authByAccountId($accountId, $password);
$authToken = $response->getAuthToken();
```

Authentication by `auth token` which `auth token` can obtain from previous authentication.
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Account\AccountApi;

$api = new AccountApi('https://zimbra.server/service/soap');
$api->authByToken($authToken);
```

Authentication by preauth which `preauth key` can obtain from `zmprov generateDomainPreAuthKey` command
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Account\AccountApi;

$api = new AccountApi('https://zimbra.server/service/soap');
$response = $api->authByPreauth($accountName, $preauthKey);
$authToken = $response->getAuthToken();
```

## Admin Authentication
Authentication by user name

```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Admin\AdminApi;

$api = new AdminApi('https://zimbra.server:7071/service/admin/soap');
$api->auth($username, $password);
```

Authentication by `auth token` which `auth token` can obtain from previous authentication.
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Admin\AdminApi;

$api = new AdminApi('https://zimbra.server:7071/service/admin/soap');
$api->authByToken($authToken);
```

## Authentication By Setting Auth Token To SOAP Header
```php
<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Zimbra\Admin\AdminApi;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;

$api = new AdminApi('https://zimbra.server:7071/service/admin/soap');
$api->setAuthToken($authToken);
$account = $api->getAccountInfo(new AccountSelector(AccountBy::NAME, $accountName));
```
