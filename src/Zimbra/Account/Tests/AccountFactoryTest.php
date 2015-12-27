<?php

namespace Zimbra\Account\Tests;

use Zimbra\Account\AccountFactory;

/**
 * Testcase class for AccountFactory.
 */
class AccountFactoryTest extends ZimbraAccountTestCase
{
    public function testAccountFactory()
    {
        $httpApi = AccountFactory::instance();
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Account\Http', $httpApi);
    }
}
