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
        $attr = new Attr($key, $value);
        $resource = new CalendarResourceInfo($name, $id, [$attr]);

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
        $response->setCalendarResourceList([$resource])
            ->addCalendarResource($resource);
        $this->assertSame([$resource, $resource], $response->getCalendarResourceList());
        $response->setCalendarResourceList([$resource]);

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
            <server by="name">$value</server>
            <domain by="name">$value</domain>
        </urn:GetAllCalendarResourcesRequest>
        <urn:GetAllCalendarResourcesResponse>
            <calresource name="$name" id="$id">
                <a n="$key">$value</a>
            </calresource>
        </urn:GetAllCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllCalendarResourcesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllCalendarResourcesRequest' => [
                    'server' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllCalendarResourcesResponse' => [
                    'calresource' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllCalendarResourcesEnvelope::class, 'json'));
    }
}
