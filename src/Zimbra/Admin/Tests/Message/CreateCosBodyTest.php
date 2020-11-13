<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCosBody;
use Zimbra\Admin\Message\CreateCosRequest;
use Zimbra\Admin\Message\CreateCosResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCosBody.
 */
class CreateCosBodyTest extends ZimbraStructTestCase
{
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
}
