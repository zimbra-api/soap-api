<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CopyCosBody;
use Zimbra\Admin\Message\CopyCosEnvelope;
use Zimbra\Admin\Message\CopyCosRequest;
use Zimbra\Admin\Message\CopyCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CopyCos.
 */
class CopyCosTest extends ZimbraStructTestCase
{
    public function testCopyCosRequest()
    {
        $newName = $this->faker->word;
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);

        $req = new CopyCosRequest($cos, $newName);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($newName, $req->getNewName());

        $req = new CopyCosRequest();
        $req->setCos($cos)
            ->setNewName($newName);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CopyCosRequest>'
                . '<name>' . $newName . '</name>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</CopyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CopyCosRequest::class, 'xml'));

        $json = json_encode([
            'name' => [
                '_content' => $newName,
            ],
            'cos' => [
                'by' => (string) CosBy::NAME(),
                '_content' => $value,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CopyCosRequest::class, 'json'));
    }

    public function testCopyCosResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]);

        $res = new CopyCosResponse($cos);
        $this->assertSame($cos, $res->getCos());

        $res = new CopyCosResponse();
        $res->setCos($cos);
        $this->assertSame($cos, $res->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CopyCosResponse>'
                . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                    . '<a n="' . $key . '" c="true" pd="false">' . $value . '</a>'
                . '</cos>'
            . '</CopyCosResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CopyCosResponse::class, 'xml'));

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
                        'pd' => FALSE,
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CopyCosResponse::class, 'json'));
    }

    public function testCopyCosBody()
    {
        $newName = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new CopyCosRequest(new CosSelector(CosBy::NAME(), $value), $newName);
        $response = new CopyCosResponse(new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]));

        $body = new CopyCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CopyCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CopyCosRequest>'
                    . '<name>' . $newName . '</name>'
                    . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                . '</urn:CopyCosRequest>'
                . '<urn:CopyCosResponse>'
                    . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                        . '<a n="' . $key . '" c="true" pd="false">' . $value . '</a>'
                    . '</cos>'
                . '</urn:CopyCosResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CopyCosBody::class, 'xml'));

        $json = json_encode([
            'CopyCosRequest' => [
                'name' => [
                    '_content' => $newName,
                ],
                'cos' => [
                    'by' => (string) CosBy::NAME(),
                    '_content' => $value,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CopyCosResponse' => [
                'cos' => [
                    'name' => $name,
                    'id' => $id,
                    'isDefaultCos' => TRUE,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                            'c' => TRUE,
                            'pd' => FALSE,
                        ],
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CopyCosBody::class, 'json'));
    }

    public function testCopyCosEnvelope()
    {
        $newName = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new CopyCosRequest(new CosSelector(CosBy::NAME(), $value), $newName);
        $response = new CopyCosResponse(new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]));
        $body = new CopyCosBody($request, $response);

        $envelope = new CopyCosEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CopyCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CopyCosRequest>'
                        . '<name>' . $newName . '</name>'
                        . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                    . '</urn:CopyCosRequest>'
                    . '<urn:CopyCosResponse>'
                        . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                            . '<a n="' . $key . '" c="true" pd="false">' . $value . '</a>'
                        . '</cos>'
                    . '</urn:CopyCosResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CopyCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CopyCosRequest' => [
                    'name' => [
                        '_content' => $newName,
                    ],
                    'cos' => [
                        'by' => (string) CosBy::NAME(),
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CopyCosResponse' => [
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                        'isDefaultCos' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                                'c' => TRUE,
                                'pd' => FALSE,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CopyCosEnvelope::class, 'json'));
    }
}
