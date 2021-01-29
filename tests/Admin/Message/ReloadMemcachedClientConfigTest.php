<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ReloadMemcachedClientConfigBody;
use Zimbra\Admin\Message\ReloadMemcachedClientConfigEnvelope;
use Zimbra\Admin\Message\ReloadMemcachedClientConfigRequest;
use Zimbra\Admin\Message\ReloadMemcachedClientConfigResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ReloadMemcachedClientConfigTest.
 */
class ReloadMemcachedClientConfigTest extends ZimbraStructTestCase
{
    public function testReloadMemcachedClientConfig()
    {
        $request = new ReloadMemcachedClientConfigRequest();
        $response = new ReloadMemcachedClientConfigResponse();

        $body = new ReloadMemcachedClientConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ReloadMemcachedClientConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ReloadMemcachedClientConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ReloadMemcachedClientConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReloadMemcachedClientConfigRequest />
        <urn:ReloadMemcachedClientConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ReloadMemcachedClientConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ReloadMemcachedClientConfigRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ReloadMemcachedClientConfigResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ReloadMemcachedClientConfigEnvelope::class, 'json'));
    }
}
