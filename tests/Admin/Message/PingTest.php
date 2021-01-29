<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\PingBody;
use Zimbra\Admin\Message\PingEnvelope;
use Zimbra\Admin\Message\PingRequest;
use Zimbra\Admin\Message\PingResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for PingTest.
 */
class PingTest extends ZimbraStructTestCase
{
    public function testPing()
    {
        $request = new PingRequest();
        $response = new PingResponse();

        $body = new PingBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PingBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PingEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PingEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PingRequest />
        <urn:PingResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PingEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'PingRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'PingResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, PingEnvelope::class, 'json'));
    }
}
