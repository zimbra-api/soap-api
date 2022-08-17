<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\DLInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DLInfo.
 */
class DLInfoTest extends ZimbraTestCase
{
    public function testDLInfo()
    {
        $via = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $dl = new StubDLInfo($via, $name, $id, FALSE, [$attr]);
        $this->assertFalse($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());

        $dl = new StubDLInfo('', $name, $id, FALSE, [$attr]);
        $dl->setDynamic(TRUE)
            ->setVia($via);
        $this->assertTrue($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" dynamic="true" via="$via" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, StubDLInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubDLInfo extends DLInfo
{
}
