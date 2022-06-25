<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GenerateUUIDEnvelope;
use Zimbra\Mail\Message\GenerateUUIDBody;
use Zimbra\Mail\Message\GenerateUUIDRequest;
use Zimbra\Mail\Message\GenerateUUIDResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GenerateUUID.
 */
class GenerateUUIDTest extends ZimbraTestCase
{
    public function testGenerateUUID()
    {
        $uuid = $this->faker->uuid;

        $request = new GenerateUUIDRequest();

        $response = new GenerateUUIDResponse($uuid);
        $this->assertSame($uuid, $response->getUuid());
        $response = new GenerateUUIDResponse($this->faker->uuid);
        $response->setUuid($uuid);
        $this->assertSame($uuid, $response->getUuid());

        $body = new GenerateUUIDBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GenerateUUIDBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GenerateUUIDEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GenerateUUIDEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GenerateUUIDRequest />
        <urn:GenerateUUIDResponse>$uuid</urn:GenerateUUIDResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GenerateUUIDEnvelope::class, 'xml'));
    }
}
