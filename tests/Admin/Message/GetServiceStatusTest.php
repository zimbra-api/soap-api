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
        $id = $this->faker->uuid;
        $displayName = $this->faker->name;
        $server = $this->faker->word;
        $service = $this->faker->word;
        $time = $this->faker->unixTime;

        $request = new GetServiceStatusRequest();

        $timezone = new TimeZoneInfo($id, $displayName);
        $status = new ServiceStatus($server, $service, $time, ZeroOrOne::ONE);
        $response = new GetServiceStatusResponse($timezone, [$status]);
        $this->assertSame($timezone, $response->getTimezone());
        $this->assertSame([$status], $response->getServiceStatuses());
        $response = new GetServiceStatusResponse();
        $response->setTimezone($timezone)
            ->setServiceStatuses([$status]);
        $this->assertSame($timezone, $response->getTimezone());
        $this->assertSame([$status], $response->getServiceStatuses());

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
            <urn:timezone id="$id" displayName="$displayName" />
            <urn:status server="$server" service="$service" t="$time">1</urn:status>
        </urn:GetServiceStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetServiceStatusEnvelope::class, 'xml'));
    }
}
