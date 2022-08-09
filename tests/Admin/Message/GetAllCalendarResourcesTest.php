<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllCalendarResourcesBody;
use Zimbra\Admin\Message\GetAllCalendarResourcesEnvelope;
use Zimbra\Admin\Message\GetAllCalendarResourcesRequest;
use Zimbra\Admin\Message\GetAllCalendarResourcesResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllCalendarResources.
 */
class GetAllCalendarResourcesTest extends ZimbraTestCase
{
    public function testGetAllCalendarResources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $resource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllCalendarResourcesRequest($server, $domain);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($domain, $request->getDomain());

        $request = new GetAllCalendarResourcesRequest();
        $request->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($domain, $request->getDomain());

        $response = new GetAllCalendarResourcesResponse([$resource]);
        $this->assertSame([$resource], $response->getCalendarResourceList());
        $response = new GetAllCalendarResourcesResponse();
        $response->setCalendarResourceList([$resource]);
        $this->assertSame([$resource], $response->getCalendarResourceList());

        $body = new GetAllCalendarResourcesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAllCalendarResourcesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllCalendarResourcesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAllCalendarResourcesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllCalendarResourcesRequest>
            <urn:server by="name">$value</urn:server>
            <urn:domain by="name">$value</urn:domain>
        </urn:GetAllCalendarResourcesRequest>
        <urn:GetAllCalendarResourcesResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:GetAllCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllCalendarResourcesEnvelope::class, 'xml'));
    }
}
