<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\EmptyDumpsterEnvelope;
use Zimbra\Mail\Message\EmptyDumpsterBody;
use Zimbra\Mail\Message\EmptyDumpsterRequest;
use Zimbra\Mail\Message\EmptyDumpsterResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EmptyDumpster.
 */
class EmptyDumpsterTest extends ZimbraTestCase
{
    public function testEmptyDumpster()
    {
        $request = new EmptyDumpsterRequest();
        $response = new EmptyDumpsterResponse();

        $body = new EmptyDumpsterBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new EmptyDumpsterBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new EmptyDumpsterEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new EmptyDumpsterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:EmptyDumpsterRequest />
        <urn:EmptyDumpsterResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, EmptyDumpsterEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'EmptyDumpsterRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'EmptyDumpsterResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, EmptyDumpsterEnvelope::class, 'json'));
    }
}
