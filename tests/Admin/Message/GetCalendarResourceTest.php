<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetCalendarResourceBody, GetCalendarResourceEnvelope, GetCalendarResourceRequest, GetCalendarResourceResponse};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Common\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCalendarResource.
 */
class GetCalendarResourceTest extends ZimbraTestCase
{
    public function testGetCalendarResource()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $calResource = new CalendarResourceSelector(CalResBy::NAME(), $value);
        $request = new GetCalendarResourceRequest($calResource, FALSE, $attrs);
        $this->assertSame($calResource, $request->getCalResource());
        $this->assertFalse($request->getApplyCos());
        $this->assertSame($attrs, $request->getAttrs());
        $request = new GetCalendarResourceRequest();
        $request->setCalResource($calResource)
            ->setApplyCos(TRUE)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($calResource, $request->getCalResource());
        $this->assertTrue($request->getApplyCos());
        $this->assertSame($attrs, $request->getAttrs());

        $calResource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);
        $response = new GetCalendarResourceResponse($calResource);
        $this->assertSame($calResource, $response->getCalResource());
        $response = new GetCalendarResourceResponse();
        $response->setCalResource($calResource);
        $this->assertSame($calResource, $response->getCalResource());

        $body = new GetCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCalendarResourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCalendarResourceRequest applyCos="true" attrs="$attrs">
            <urn:calresource by="name">$value</urn:calresource>
        </urn:GetCalendarResourceRequest>
        <urn:GetCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:GetCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCalendarResourceEnvelope::class, 'xml'));
    }
}
