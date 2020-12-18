<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ModifyCalendarResourceBody;
use Zimbra\Admin\Message\ModifyCalendarResourceEnvelope;
use Zimbra\Admin\Message\ModifyCalendarResourceRequest;
use Zimbra\Admin\Message\ModifyCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyCalendarResource.
 */
class ModifyCalendarResourceTest extends ZimbraStructTestCase
{
    public function testModifyCalendarResource()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $calResource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);

        $request = new ModifyCalendarResourceRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyCalendarResourceRequest('');
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $response = new ModifyCalendarResourceResponse($calResource);
        $this->assertEquals($calResource, $response->getCalResource());
        $response = new ModifyCalendarResourceResponse(new CalendarResourceInfo('', ''));
        $response->setCalResource($calResource);
        $this->assertEquals($calResource, $response->getCalResource());

        $body = new ModifyCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyCalendarResourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyCalendarResourceRequest id="$id">
            <a n="$key">$value</a>
        </urn:ModifyCalendarResourceRequest>
        <urn:ModifyCalendarResourceResponse>
            <calresource name="$name" id="$id">
                <a n="$key">$value</a>
            </calresource>
        </urn:ModifyCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyCalendarResourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyCalendarResourceRequest' => [
                    'id' => $id,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ModifyCalendarResourceResponse' => [
                    'calresource' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyCalendarResourceEnvelope::class, 'json'));
    }
}
