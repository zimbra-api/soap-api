<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetICalEnvelope;
use Zimbra\Mail\Message\GetICalBody;
use Zimbra\Mail\Message\GetICalRequest;
use Zimbra\Mail\Message\GetICalResponse;

use Zimbra\Mail\Struct\ICalContent;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetICal.
 */
class GetICalTest extends ZimbraTestCase
{
    public function testGetICal()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $ical = $this->faker->text;

        $request = new GetICalRequest($id, $startTime, $endTime);
        $this->assertSame($id, $request->getId());
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $request = new GetICalRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setId($id);
        $this->assertSame($id, $request->getId());
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());

        $content = new ICalContent(
            $id, $ical
        );
        $response = new GetICalResponse($content);
        $this->assertSame($content, $response->getContent());
        $response = new GetICalResponse(new ICalContent());
        $response->setContent($content);
        $this->assertSame($content, $response->getContent());

        $body = new GetICalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetICalBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetICalEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetICalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetICalRequest id="$id" s="$startTime" e="$endTime" />
        <urn:GetICalResponse>
            <ical id="$id">$ical</ical>
        </urn:GetICalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetICalEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetICalRequest' => [
                    'id' => $id,
                    's' => $startTime,
                    'e' => $endTime,
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetICalResponse' => [
                    'ical' => [
                        'id' => $id,
                        '_content' => $ical,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetICalEnvelope::class, 'json'));
    }
}
