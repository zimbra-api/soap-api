<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetIMAPRecentCutoffEnvelope;
use Zimbra\Mail\Message\GetIMAPRecentCutoffBody;
use Zimbra\Mail\Message\GetIMAPRecentCutoffRequest;
use Zimbra\Mail\Message\GetIMAPRecentCutoffResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetIMAPRecentCutoff.
 */
class GetIMAPRecentCutoffTest extends ZimbraTestCase
{
    public function testGetIMAPRecentCutoff()
    {
        $id = $this->faker->uuid;
        $cutoff = $this->faker->randomNumber;

        $request = new GetIMAPRecentCutoffRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetIMAPRecentCutoffRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new GetIMAPRecentCutoffResponse($cutoff);
        $this->assertSame($cutoff, $response->getCutoff());
        $response = new GetIMAPRecentCutoffResponse();
        $response->setCutoff($cutoff);
        $this->assertSame($cutoff, $response->getCutoff());

        $body = new GetIMAPRecentCutoffBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetIMAPRecentCutoffBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetIMAPRecentCutoffEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetIMAPRecentCutoffEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetIMAPRecentCutoffRequest id="$id" />
        <urn:GetIMAPRecentCutoffResponse cutoff="$cutoff" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetIMAPRecentCutoffEnvelope::class, 'xml'));
    }
}
