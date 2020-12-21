<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ReloadLocalConfigBody;
use Zimbra\Admin\Message\ReloadLocalConfigEnvelope;
use Zimbra\Admin\Message\ReloadLocalConfigRequest;
use Zimbra\Admin\Message\ReloadLocalConfigResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ReloadLocalConfigTest.
 */
class ReloadLocalConfigTest extends ZimbraStructTestCase
{
    public function testReloadLocalConfig()
    {
        $request = new ReloadLocalConfigRequest();
        $response = new ReloadLocalConfigResponse();

        $body = new ReloadLocalConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ReloadLocalConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ReloadLocalConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ReloadLocalConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReloadLocalConfigRequest />
        <urn:ReloadLocalConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ReloadLocalConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ReloadLocalConfigRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ReloadLocalConfigResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ReloadLocalConfigEnvelope::class, 'json'));
    }
}
