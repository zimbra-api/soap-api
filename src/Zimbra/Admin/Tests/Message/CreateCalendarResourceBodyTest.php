<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCalendarResourceBody;
use Zimbra\Admin\Message\CreateCalendarResourceRequest;
use Zimbra\Admin\Message\CreateCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCalendarResourceBody.
 */
class CreateCalendarResourceBodyTest extends ZimbraStructTestCase
{
    public function testCreateCalendarResourceBody()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $calResource = new CalendarResourceInfo($name, $id, [$attr]);

        $request = new CreateCalendarResourceRequest(
            $name, $password, [$attr]
        );
        $response = new CreateCalendarResourceResponse($calResource);

        $body = new CreateCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateCalendarResourceRequest>'
                . '<urn:CreateCalendarResourceResponse>'
                    . '<calresource name="' . $name . '" id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</calresource>'
                . '</urn:CreateCalendarResourceResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateCalendarResourceBody::class, 'xml'));

        $json = json_encode([
            'CreateCalendarResourceRequest' => [
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateCalendarResourceResponse' => [
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateCalendarResourceBody::class, 'json'));
    }
}
