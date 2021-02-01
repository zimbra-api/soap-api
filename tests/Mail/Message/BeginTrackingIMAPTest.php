<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\BeginTrackingIMAPEnvelope;
use Zimbra\Mail\Message\BeginTrackingIMAPBody;
use Zimbra\Mail\Message\BeginTrackingIMAPRequest;
use Zimbra\Mail\Message\BeginTrackingIMAPResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BeginTrackingIMAP.
 */
class BeginTrackingIMAPTest extends ZimbraTestCase
{
    public function testBeginTrackingIMAP()
    {
        $request = new BeginTrackingIMAPRequest();
        $response = new BeginTrackingIMAPResponse();

        $body = new BeginTrackingIMAPBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new BeginTrackingIMAPBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new BeginTrackingIMAPEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new BeginTrackingIMAPEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BeginTrackingIMAPRequest />
        <urn:BeginTrackingIMAPResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, BeginTrackingIMAPEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'BeginTrackingIMAPRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'BeginTrackingIMAPResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, BeginTrackingIMAPEnvelope::class, 'json'));
    }
}
