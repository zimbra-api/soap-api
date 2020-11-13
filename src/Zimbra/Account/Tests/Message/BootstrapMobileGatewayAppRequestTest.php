<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\BootstrapMobileGatewayAppRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BootstrapMobileGatewayAppRequest.
 */
class BootstrapMobileGatewayAppRequestTest extends ZimbraStructTestCase
{
    public function testBootstrapMobileGatewayAppRequest()
    {
        $req = new BootstrapMobileGatewayAppRequest(FALSE);
        $this->assertFalse($req->getWantAppToken());

        $req = new BootstrapMobileGatewayAppRequest();
        $req->setWantAppToken(TRUE);
        $this->assertTrue($req->getWantAppToken());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<BootstrapMobileGatewayAppRequest xmlns="urn:zimbraAccount" wantAppToken="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, BootstrapMobileGatewayAppRequest::class, 'xml'));

        $json = json_encode([
            'wantAppToken' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, BootstrapMobileGatewayAppRequest::class, 'json'));
    }
}
