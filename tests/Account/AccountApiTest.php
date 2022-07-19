<?php declare(strict_types=1);

namespace Zimbra\Tests\Account;

use Zimbra\Account\{AccountApi, AccountApiInterface};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class AccountApiTest extends ZimbraTestCase
{
    public function testAccountApi()
    {
        $api = new AccountApi('https://localhost');
        $this->assertTrue($api instanceof AccountApiInterface);
    }
}
