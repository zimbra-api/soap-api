<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;

/**
 * Testcase class for Base.
 */
class BaseTest extends ZimbraMailApiTestCase
{
    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Mail\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraMail', $req->getXmlNamespace());
    }
}
