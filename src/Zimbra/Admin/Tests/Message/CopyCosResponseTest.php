<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CopyCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CopyCosResponse.
 */
class CopyCosResponseTest extends ZimbraStructTestCase
{
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
}
