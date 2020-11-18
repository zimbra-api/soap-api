<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCalendarResourceBody;
use Zimbra\Admin\Message\CreateCalendarResourceEnvelope;
use Zimbra\Admin\Message\CreateCalendarResourceRequest;
use Zimbra\Admin\Message\CreateCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCalendarResource.
 */
class CreateCalendarResourceTest extends ZimbraStructTestCase
{
    public function testCreateCalendarResource()
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
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());
        $request = new CreateCalendarResourceRequest('', '');
        $request->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());

        $response = new CreateCalendarResourceResponse($calResource);
        $this->assertSame($calResource, $response->getCalResource());
        $response = new CreateCalendarResourceResponse(new CalendarResourceInfo('', ''));
        $response->setCalResource($calResource);
        $this->assertSame($calResource, $response->getCalResource());

        $body = new CreateCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateCalendarResourceEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateCalendarResourceRequest>'
                    . '<urn:CreateCalendarResourceResponse>'
                        . '<calresource name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</calresource>'
                    . '</urn:CreateCalendarResourceResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateCalendarResourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateCalendarResourceEnvelope::class, 'json'));
    }
}
