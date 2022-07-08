<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ICalReplyEnvelope;
use Zimbra\Mail\Message\ICalReplyBody;
use Zimbra\Mail\Message\ICalReplyRequest;
use Zimbra\Mail\Message\ICalReplyResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ICalReply.
 */
class ICalReplyTest extends ZimbraTestCase
{
    public function testICalReply()
    {
        $ical = $this->faker->text;
        $request = new ICalReplyRequest($ical);
        $this->assertSame($ical, $request->getIcal());
        $request = new ICalReplyRequest();
        $request->setIcal($ical);
        $this->assertSame($ical, $request->getIcal());
        $response = new ICalReplyResponse();

        $body = new ICalReplyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ICalReplyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ICalReplyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ICalReplyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ICalReplyRequest>
            <urn:ical>$ical</urn:ical>
        </urn:ICalReplyRequest>
        <urn:ICalReplyResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ICalReplyEnvelope::class, 'xml'));
    }
}
