<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountObjectsResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountObjectsResponse.
 */
class CountObjectsResponseTest extends ZimbraStructTestCase
{
    public function testCountObjectsResponse()
    {
        $num = mt_rand(1, 100);
        $type = $this->faker->word;
        $res = new CountObjectsResponse($num, $type);
        $this->assertSame($num, $res->getNum());
        $this->assertSame($type, $res->getType());

        $res = new CountObjectsResponse(0, '');
        $res->setNum($num)
            ->setType($type);
        $this->assertSame($num, $res->getNum());
        $this->assertSame($type, $res->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsResponse num="' . $num . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CountObjectsResponse::class, 'xml'));

        $json = json_encode([
            'num' => $num,
            'type' => $type,
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CountObjectsResponse::class, 'json'));
    }
}
