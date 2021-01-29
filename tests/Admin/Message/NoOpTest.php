<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\NoOpBody;
use Zimbra\Admin\Message\NoOpEnvelope;
use Zimbra\Admin\Message\NoOpRequest;
use Zimbra\Admin\Message\NoOpResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for NoOpTest.
 */
class NoOpTest extends ZimbraStructTestCase
{
    public function testNoOp()
    {
        $request = new NoOpRequest();
        $response = new NoOpResponse();

        $body = new NoOpBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new NoOpBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new NoOpEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new NoOpEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:NoOpRequest />
        <urn:NoOpResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, NoOpEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'NoOpRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'NoOpResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, NoOpEnvelope::class, 'json'));
    }
}
