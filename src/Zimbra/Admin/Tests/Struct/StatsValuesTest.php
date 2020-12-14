<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for StatsValues.
 */
class StatsValuesTest extends ZimbraStructTestCase
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

        $values = new StatsValues($t, [$stat1]);
        $this->assertSame($t, $values->getT());
        $this->assertSame([$stat1], $values->getStats());

        $values = new StatsValues('');
        $values->setT($t)
             ->setStats([$stat1])
             ->addStat($stat2);
        $this->assertSame($t, $values->getT());
        $this->assertSame([$stat1, $stat2], $values->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<values t="$t">
    <stat name="$name1" value="$value1" />
    <stat name="$name2" value="$value2" />
</values>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));
        $this->assertEquals($values, $this->serializer->deserialize($xml, StatsValues::class, 'xml'));

        $json = json_encode([
            't' => $t,
            'stat' => [
                [
                    'name' => $name1,
                    'value' => $value1,
                ],
                [
                    'name' => $name2,
                    'value' => $value2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($values, 'json'));
        $this->assertEquals($values, $this->serializer->deserialize($json, StatsValues::class, 'json'));
    }
}
