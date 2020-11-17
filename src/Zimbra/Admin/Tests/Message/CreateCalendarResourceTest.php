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
    public function testCreateCalendarResourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateCalendarResourceRequest(
            $name, $password, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req = new CreateCalendarResourceRequest('', '');
        $req->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateCalendarResourceRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'password' => $password,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateCalendarResourceRequest::class, 'json'));
    }

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

    public function testCreateCalendarResourceEnvelope()
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
