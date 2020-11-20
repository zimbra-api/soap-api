<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Struct\Tests\ZimbraStructTestCase;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\Attr;

/**
 * Testcase class for GalContactInfo.
 */
class GalContactInfoTest extends ZimbraStructTestCase
{
    public function testGalContactInfo()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cn = new GalContactInfo($id, [new Attr($key, $value)]);
        $this->assertSame($id, $cn->getId());

        $cn = new GalContactInfo('', [new Attr($key, $value)]);
        $cn->setId($id);
        $this->assertSame($id, $cn->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cn id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</cn>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cn, 'xml'));
        $this->assertEquals($cn, $this->serializer->deserialize($xml, GalContactInfo::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cn, 'json'));
        $this->assertEquals($cn, $this->serializer->deserialize($json, GalContactInfo::class, 'json'));
    }
}
