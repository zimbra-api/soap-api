<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;

/**
 * Testcase class for BaseRequest.
 */
class BaseRequestTest extends ZimbraVoiceApiTestCase
{
    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Voice\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraVoice', $req->getXmlNamespace());
    }
}
