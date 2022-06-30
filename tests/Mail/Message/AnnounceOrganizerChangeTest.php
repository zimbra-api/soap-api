<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\AnnounceOrganizerChangeEnvelope;
use Zimbra\Mail\Message\AnnounceOrganizerChangeBody;
use Zimbra\Mail\Message\AnnounceOrganizerChangeRequest;
use Zimbra\Mail\Message\AnnounceOrganizerChangeResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AnnounceOrganizerChange.
 */
class AnnounceOrganizerChangeTest extends ZimbraTestCase
{
    public function testAnnounceOrganizerChange()
    {
        $id = $this->faker->uuid;

        $request = new AnnounceOrganizerChangeRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new AnnounceOrganizerChangeRequest();
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new AnnounceOrganizerChangeResponse();

        $body = new AnnounceOrganizerChangeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AnnounceOrganizerChangeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AnnounceOrganizerChangeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AnnounceOrganizerChangeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AnnounceOrganizerChangeRequest id="$id" />
        <urn:AnnounceOrganizerChangeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AnnounceOrganizerChangeEnvelope::class, 'xml'));
    }
}
