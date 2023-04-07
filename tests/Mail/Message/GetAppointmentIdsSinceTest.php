<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Struct\AppointmentIdAndDate;

use Zimbra\Mail\Message\GetAppointmentIdsSinceEnvelope;
use Zimbra\Mail\Message\GetAppointmentIdsSinceBody;
use Zimbra\Mail\Message\GetAppointmentIdsSinceRequest;
use Zimbra\Mail\Message\GetAppointmentIdsSinceResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAppointmentIdsSince.
 */
class GetAppointmentIdsSinceTest extends ZimbraTestCase
{
    public function testGetAppointmentIdsSince()
    {
        $lastSync = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;

        $mid = $this->faker->randomNumber;
        $did = $this->faker->randomNumber;

        $request = new GetAppointmentIdsSinceRequest($lastSync, $folderId);
        $this->assertSame($lastSync, $request->getLastSync());
        $this->assertSame($folderId, $request->getFolderId());
        $request = new GetAppointmentIdsSinceRequest();
        $request->setLastSync($lastSync)
            ->setFolderId($folderId);
        $this->assertSame($lastSync, $request->getLastSync());
        $this->assertSame($folderId, $request->getFolderId());

        $response = new GetAppointmentIdsSinceResponse([$mid], [$did]);
        $this->assertSame([$mid], $response->getMids());
        $this->assertSame([$did], $response->getDids());
        $response = new GetAppointmentIdsSinceResponse();
        $response->setMids([$mid])
            ->setDids([$did]);
        $this->assertSame([$mid], $response->getMids());
        $this->assertSame([$did], $response->getDids());

        $body = new GetAppointmentIdsSinceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAppointmentIdsSinceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAppointmentIdsSinceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAppointmentIdsSinceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetAppointmentIdsSinceRequest lastSync="$lastSync" l="$folderId" />
        <urn:GetAppointmentIdsSinceResponse>
            <urn:mids>$mid</urn:mids>
            <urn:dids>$did</urn:dids>
        </urn:GetAppointmentIdsSinceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAppointmentIdsSinceEnvelope::class, 'xml'));
    }
}
