<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;

/**
 * Testcase class for BaseRequest.
 */
class BaseRequestTest extends ZimbraAccountApiTestCase
{
    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Account\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAccount', $req->getXmlNamespace());

        $req = $this->getMockForAbstractClass('\Zimbra\Account\Request\BaseAttr');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAccount', $req->getXmlNamespace());
    }
}
