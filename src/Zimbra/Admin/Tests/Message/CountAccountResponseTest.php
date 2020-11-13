<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountAccountResponse;
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountAccountResponse.
 */
class CountAccountResponseTest extends ZimbraStructTestCase
{
    public function testCountAccountResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);
        $cos = new CosCountInfo($name, $id, $count);

        $res = new CountAccountResponse([$cos]);
        $this->assertSame([$cos], $res->getCos());

        $res = new CountAccountResponse();
        $res->setCos([$cos])
            ->addCos($cos);
        $this->assertSame([$cos, $cos], $res->getCos());

        $res = new CountAccountResponse([$cos]);
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountAccountResponse>'
                . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
            . '</CountAccountResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CountAccountResponse::class, 'xml'));

        $json = json_encode([
            'cos' => [
                [
                    'name' => $name,
                    'id' => $id,
                    '_content' => $count,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CountAccountResponse::class, 'json'));
    }
}
