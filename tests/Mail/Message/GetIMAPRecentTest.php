<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetIMAPRecentEnvelope;
use Zimbra\Mail\Message\GetIMAPRecentBody;
use Zimbra\Mail\Message\GetIMAPRecentRequest;
use Zimbra\Mail\Message\GetIMAPRecentResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetIMAPRecent.
 */
class GetIMAPRecentTest extends ZimbraTestCase
{
    public function testGetIMAPRecent()
    {
        $id = $this->faker->uuid;
        $num = $this->faker->randomNumber;

        $request = new GetIMAPRecentRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetIMAPRecentRequest();
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new GetIMAPRecentResponse($num);
        $this->assertSame($num, $response->getNum());
        $response = new GetIMAPRecentResponse();
        $response->setNum($num);
        $this->assertSame($num, $response->getNum());

        $body = new GetIMAPRecentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetIMAPRecentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetIMAPRecentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetIMAPRecentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetIMAPRecentRequest id="$id" />
        <urn:GetIMAPRecentResponse n="$num" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetIMAPRecentEnvelope::class, 'xml'));
    }
}
