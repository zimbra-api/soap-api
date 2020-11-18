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
    public function testCreateCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new CreateCosRequest(
            $name, [new Attr($key, $value)]
        );
        $this->assertSame($name, $request->getName());
        $request = new CreateCosRequest('');
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $response = new CreateCosResponse($cos);
        $this->assertSame($cos, $response->getCos());
        $response = new CreateCosResponse(new CosInfo('', ''));
        $response->setCos($cos);
        $this->assertSame($cos, $response->getCos());

        $body = new CreateCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

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
