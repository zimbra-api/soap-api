<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for UCServiceInfo.
 */
class UCServiceInfoTest extends ZimbraStructTestCase
{
    public function testUCServiceInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ucservice = new UCServiceInfo($name, $id, [new Attr($key, $value)]);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ucservice name="' . $name . '" id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ucservice, 'xml'));
        $this->assertEquals($ucservice, $this->serializer->deserialize($xml, UCServiceInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ucservice, 'json'));
        $this->assertEquals($ucservice, $this->serializer->deserialize($json, UCServiceInfo::class, 'json'));
    }
}
