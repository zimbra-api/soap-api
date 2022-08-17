<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZimletInfo.
 */
class ZimletInfoTest extends ZimbraTestCase
{
    public function testZimletInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $hasKeyword = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $zimlet = new StubZimletInfo($name, $id, [new Attr($key, $value)], $hasKeyword);
        $this->assertSame($hasKeyword, $zimlet->getHasKeyword());
        $zimlet = new StubZimletInfo($name, $id, [new Attr($key, $value)]);
        $zimlet->setHasKeyword($hasKeyword);
        $this->assertSame($hasKeyword, $zimlet->getHasKeyword());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" hasKeyword="$hasKeyword" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, StubZimletInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubZimletInfo extends ZimletInfo
{
}
