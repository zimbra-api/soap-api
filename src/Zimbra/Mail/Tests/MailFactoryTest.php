<?php

namespace Zimbra\Mail\Tests;

use Zimbra\Mail\MailFactory;

/**
 * Testcase class for MailFactory.
 */
class MailFactoryTest extends ZimbraMailTestCase
{
    public function testMailFactory()
    {
        $httpApi = MailFactory::instance();
        $this->assertInstanceOf('\Zimbra\Mail\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Mail\Http', $httpApi);
    }
}
