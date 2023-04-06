<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Struct\AppointmentIdAndDate;

use Zimbra\Mail\Message\GetAppointmentIdsInRangeEnvelope;
use Zimbra\Mail\Message\GetAppointmentIdsInRangeBody;
use Zimbra\Mail\Message\GetAppointmentIdsInRangeRequest;
use Zimbra\Mail\Message\GetAppointmentIdsInRangeResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAppointmentIdsInRange.
 */
class GetAppointmentIdsInRangeTest extends ZimbraTestCase
{
    public function testGetAppointmentIdsInRange()
    {
        $startTime = $this->faker->randomNumber;
        $endTime = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $id = $this->faker->uuid;
        $date = $this->faker->randomNumber;

        $request = new GetAppointmentIdsInRangeRequest($startTime, $endTime, $folderId);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($folderId, $request->getFolderId());
        $request = new GetAppointmentIdsInRangeRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setFolderId($folderId);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($folderId, $request->getFolderId());

        $apptData = new AppointmentIdAndDate(
            $id, $date
        );
        $response = new GetAppointmentIdsInRangeResponse([$apptData]);
        $this->assertSame([$apptData], $response->getAppointmentData());
        $response = new GetAppointmentIdsInRangeResponse();
        $response->setAppointmentData([$apptData]);
        $this->assertSame([$apptData], $response->getAppointmentData());

        $body = new GetAppointmentIdsInRangeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAppointmentIdsInRangeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAppointmentIdsInRangeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAppointmentIdsInRangeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetAppointmentIdsInRangeRequest s="$startTime" e="$endTime" l="$folderId" />
        <urn:GetAppointmentIdsInRangeResponse>
            <urn:apptData id="$id" d="$date" />
        </urn:GetAppointmentIdsInRangeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAppointmentIdsInRangeEnvelope::class, 'xml'));
    }
}
