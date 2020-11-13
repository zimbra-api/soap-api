<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCosResponse.
 */
class CreateCosResponseTest extends ZimbraStructTestCase
{
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
}
