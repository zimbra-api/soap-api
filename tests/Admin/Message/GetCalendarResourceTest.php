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

        $calendarSel = new CalendarResourceSelector(CalResBy::NAME(), $value);
        $calendarInfo = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetCalendarResourceRequest($calendarSel, FALSE, $attrs);
        $this->assertSame($calendarSel, $request->getCalResource());
        $this->assertFalse($request->getApplyCos());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetCalendarResourceRequest();
        $request->setCalResource($calendarSel)
            ->setApplyCos(TRUE)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($calendarSel, $request->getCalResource());
        $this->assertTrue($request->getApplyCos());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetCalendarResourceResponse($calendarInfo);
        $this->assertSame($calendarInfo, $response->getCalResource());
        $response = new GetCalendarResourceResponse(new CalendarResourceInfo(',', ''));
        $response->setCalResource($calendarInfo);
        $this->assertSame($calendarInfo, $response->getCalResource());

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
            <calresource by="name">$value</calresource>
        </urn:GetCalendarResourceRequest>
        <urn:GetCalendarResourceResponse>
            <calresource name="$name" id="$id">
                <a n="$key">$value</a>
            </calresource>
        </urn:GetCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCalendarResourceEnvelope::class, 'xml'));
    }
}
