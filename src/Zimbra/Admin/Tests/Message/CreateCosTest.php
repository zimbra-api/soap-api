<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCosBody;
use Zimbra\Admin\Message\CreateCosEnvelope;
use Zimbra\Admin\Message\CreateCosRequest;
use Zimbra\Admin\Message\CreateCosResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCos.
 */
class CreateCosTest extends ZimbraStructTestCase
{
    public function testCreateCosRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateCosRequest(
            $name, [$attr]
        );

        $this->assertSame($name, $req->getName());

        $req = new CreateCosRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCosRequest>'
                . '<name>' . $name . '</name>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateCosRequest::class, 'xml'));

        $json = json_encode([
            'name' => [
                '_content' => $name,
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateCosRequest::class, 'json'));
    }

    public function testCreateCosResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new CosInfoAttr($key, $value, TRUE, TRUE);
        $cos = new CosInfo($name, $id, TRUE, [$attr]);

        $res = new CreateCosResponse($cos);
        $this->assertSame($cos, $res->getCos());

        $res = new CreateCosResponse(new CosInfo('', ''));
        $res->setCos($cos);
        $this->assertSame($cos, $res->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCosResponse>'
                . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                    . '<a n="' . $key . '" c="true" pd="true">' . $value . '</a>'
                . '</cos>'
            . '</CreateCosResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateCosResponse::class, 'xml'));

        $json = json_encode([
            'cos' => [
                'name' => $name,
                'id' => $id,
                'isDefaultCos' => TRUE,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                        'c' => TRUE,
                        'pd' => TRUE,
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateCosResponse::class, 'json'));
    }

    public function testCreateCosBody()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $request = new CreateCosRequest(
            $name, [new Attr($key, $value)]
        );
        $response = new CreateCosResponse($cos);

        $body = new CreateCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateCosRequest>'
                    . '<name>' . $name . '</name>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateCosRequest>'
                . '<urn:CreateCosResponse>'
                    . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                        . '<a n="' . $key . '" c="true" pd="true">' . $value . '</a>'
                    . '</cos>'
                . '</urn:CreateCosResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateCosBody::class, 'xml'));

        $json = json_encode([
            'CreateCosRequest' => [
                'name' => [
                    '_content' => $name,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateCosResponse' => [
                'cos' => [
                    'name' => $name,
                    'id' => $id,
                    'isDefaultCos' => TRUE,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                            'c' => TRUE,
                            'pd' => TRUE,
                        ],
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateCosBody::class, 'json'));
    }

    public function testCreateCosEnvelope()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $request = new CreateCosRequest(
            $name, [new Attr($key, $value)]
        );
        $response = new CreateCosResponse($cos);
        $body = new CreateCosBody($request, $response);

        $envelope = new CreateCosEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateCosRequest>'
                        . '<name>' . $name . '</name>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateCosRequest>'
                    . '<urn:CreateCosResponse>'
                        . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                            . '<a n="' . $key . '" c="true" pd="true">' . $value . '</a>'
                        . '</cos>'
                    . '</urn:CreateCosResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateCosRequest' => [
                    'name' => [
                        '_content' => $name,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateCosResponse' => [
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                        'isDefaultCos' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                                'c' => TRUE,
                                'pd' => TRUE,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateCosEnvelope::class, 'json'));
    }
}
