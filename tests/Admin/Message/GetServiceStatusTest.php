<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetServiceStatusBody;
use Zimbra\Admin\Message\GetServiceStatusEnvelope;
use Zimbra\Admin\Message\GetServiceStatusRequest;
use Zimbra\Admin\Message\GetServiceStatusResponse;

use Zimbra\Admin\Struct\ServiceStatus;
use Zimbra\Admin\Struct\TimeZoneInfo;
use Zimbra\Common\Enum\ZeroOrOne;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetServiceStatusTest.
 */
class GetServiceStatusTest extends ZimbraTestCase
{
    public function testGetServiceStatus()
    {
        $id = $this->faker->word;
        $displayName = $this->faker->word;
        $server = $this->faker->word;
        $service = $this->faker->word;
        $time = time();

        $request = new GetServiceStatusRequest();

        $timezone = new TimeZoneInfo($id, $displayName);
        $status = new ServiceStatus($server, $service, $time, ZeroOrOne::ONE());
        $response = new GetServiceStatusResponse($timezone, [$status]);
        $this->assertSame($timezone, $response->getTimezone());
        $this->assertSame([$status], $response->getServiceStatuses());
        $response = new GetServiceStatusResponse(new TimeZoneInfo('', ''));
        $response->setTimezone($timezone)
            ->setServiceStatuses([$status])
            ->addServiceStatus($status);
        $this->assertSame($timezone, $response->getTimezone());
        $this->assertSame([$status, $status], $response->getServiceStatuses());
        $response->setServiceStatuses([$status]);

        $body = new GetServiceStatusBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetServiceStatusBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetServiceStatusEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetServiceStatusEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServiceStatusRequest />
        <urn:GetServiceStatusResponse>
            <timezone id="$id" displayName="$displayName" />
            <status server="$server" service="$service" t="$time">1</status>
        </urn:GetServiceStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetServiceStatusEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetServiceStatusRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetServiceStatusResponse' => [
                    'timezone' => [
                        'id' => $id,
                        'displayName' => $displayName,
                    ],
                    'status' => [
                        [
                            'server' => $server,
                            'service' => $service,
                            't' => $time,
                            '_content' => '1',
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetServiceStatusEnvelope::class, 'json'));
    }
}
