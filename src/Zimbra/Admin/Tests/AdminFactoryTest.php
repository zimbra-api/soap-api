<?php

namespace Zimbra\Admin\Tests;

use Zimbra\Admin\AdminFactory;

/**
 * Testcase class for AdminFactory.
 */
class AdminFactoryTest extends ZimbraAdminTestCase
{
    public function testAdminFactory()
    {
        $httpApi = AdminFactory::instance();
        $this->assertInstanceOf('\Zimbra\Admin\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Admin\Http', $httpApi);
    }
}
