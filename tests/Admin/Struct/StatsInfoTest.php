<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\StatsInfo;
use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StatsInfo.
 */
class StatsInfoTest extends ZimbraTestCase
{
    public function testStatsInfo()
    {
        $t = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $values = new StatsValues($t, [new NameAndValue($name, $value)]);

        $stats = new StubStatsInfo($name, $values);
        $this->assertSame($name, $stats->getName());
        $this->assertSame($values, $stats->getValues());

        $stats = new StubStatsInfo();
        $stats->setName($name)
             ->setValues($values);
        $this->assertSame($name, $stats->getName());
        $this->assertSame($values, $stats->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:values t="$t">
        <urn:stat name="$name" value="$value" />
    </urn:values>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, StubStatsInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubStatsInfo extends StatsInfo
{
}
