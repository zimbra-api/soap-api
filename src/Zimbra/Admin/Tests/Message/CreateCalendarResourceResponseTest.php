<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCalendarResourceResponse.
 */
class CreateCalendarResourceResponseTest extends ZimbraStructTestCase
{
    public function testCreateCalendarResourceResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $calResource = new CalendarResourceInfo($name, $id, [$attr]);

        $res = new CreateCalendarResourceResponse($calResource);
        $this->assertSame($calResource, $res->getCalResource());

        $res = new CreateCalendarResourceResponse(new CalendarResourceInfo('', ''));
        $res->setCalResource($calResource);
        $this->assertSame($calResource, $res->getCalResource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCalendarResourceResponse>'
                . '<calresource name="' . $name . '" id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</calresource>'
            . '</CreateCalendarResourceResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateCalendarResourceResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateCalendarResourceResponse::class, 'json'));
    }
}
