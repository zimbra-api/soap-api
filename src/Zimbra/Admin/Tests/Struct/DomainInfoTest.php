<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DomainInfo.
 */
class DomainInfoTest extends ZimbraStructTestCase
{
    public function testDomainInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $domain = new DomainInfo($name, $id, [new Attr($key, $value)]);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain name="' . $name . '" id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</domain>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainInfo::class, 'xml'));

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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($domain, 'json'));
        $this->assertEquals($domain, $this->serializer->deserialize($json, DomainInfo::class, 'json'));
    }
}
