<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\SendDeliveryReportEnvelope;
use Zimbra\Mail\Message\SendDeliveryReportBody;
use Zimbra\Mail\Message\SendDeliveryReportRequest;
use Zimbra\Mail\Message\SendDeliveryReportResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SendDeliveryReport.
 */
class SendDeliveryReportTest extends ZimbraTestCase
{
    public function testSendDeliveryReport()
    {
        $messageId = $this->faker->uuid;
        $request = new SendDeliveryReportRequest($messageId);
        $this->assertSame($messageId, $request->getMessageId());
        $request = new SendDeliveryReportRequest();
        $request->setMessageId($messageId);
        $this->assertSame($messageId, $request->getMessageId());

        $response = new SendDeliveryReportResponse();

        $body = new SendDeliveryReportBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SendDeliveryReportBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SendDeliveryReportEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SendDeliveryReportEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendDeliveryReportRequest mid="$messageId" />
        <urn:SendDeliveryReportResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SendDeliveryReportEnvelope::class, 'xml'));
    }
}
