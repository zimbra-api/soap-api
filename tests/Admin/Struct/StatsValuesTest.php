<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StatsValues.
 */
class StatsValuesTest extends ZimbraTestCase
{
    public function testStatsValues()
    {
        $t = $this->faker->word;

        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $name2 = $this->faker->word;
        $value2 = $this->faker->word;

        $stat1 = new NameAndValue($name1, $value1);
        $stat2 = new NameAndValue($name2, $value2);

        $values = new StubStatsValues($t, [$stat1]);
        $this->assertSame($t, $values->getT());
        $this->assertSame([$stat1], $values->getStats());

        $values = new StubStatsValues();
        $values->setT($t)
             ->setStats([$stat1])
             ->addStat($stat2);
        $this->assertSame($t, $values->getT());
        $this->assertSame([$stat1, $stat2], $values->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<result t="$t" xmlns:urn="urn:zimbraAdmin">
    <urn:stat name="$name1" value="$value1" />
    <urn:stat name="$name2" value="$value2" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));
        $this->assertEquals($values, $this->serializer->deserialize($xml, StubStatsValues::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubStatsValues extends StatsValues
{
}
