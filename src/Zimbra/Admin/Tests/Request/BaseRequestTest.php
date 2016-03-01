<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;

/**
 * Testcase class for BaseRequest.
 */
class BaseRequestTest extends ZimbraAdminApiTestCase
{
    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->getXmlNamespace());

        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\BaseAttr');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->getXmlNamespace());
    }
}
