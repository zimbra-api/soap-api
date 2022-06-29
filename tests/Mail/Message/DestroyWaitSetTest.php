<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\DestroyWaitSetEnvelope;
use Zimbra\Mail\Message\DestroyWaitSetBody;
use Zimbra\Mail\Message\DestroyWaitSetRequest;
use Zimbra\Mail\Message\DestroyWaitSetResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DestroyWaitSet.
 */
class DestroyWaitSetTest extends ZimbraTestCase
{
    public function testDestroyWaitSet()
    {
        $waitSetId = $this->faker->uuid;

        $request = new DestroyWaitSetRequest($waitSetId);
        $this->assertSame($waitSetId, $request->getWaitSetId());
        $request = new DestroyWaitSetRequest();
        $request->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $request->getWaitSetId());

        $response = new DestroyWaitSetResponse($waitSetId);
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $response = new DestroyWaitSetResponse();
        $response->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $response->getWaitSetId());

        $body = new DestroyWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DestroyWaitSetBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DestroyWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DestroyWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DestroyWaitSetRequest waitSet="$waitSetId" />
        <urn:DestroyWaitSetResponse waitSet="$waitSetId" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DestroyWaitSetEnvelope::class, 'xml'));
    }
}
