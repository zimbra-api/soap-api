<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $stats = new StatsInfo($name, $values);
        $this->assertSame($name, $stats->getName());
        $this->assertSame($values, $stats->getValues());

        $stats = new StatsInfo('');
        $stats->setName($name)
             ->setValues($values);
        $this->assertSame($name, $stats->getName());
        $this->assertSame($values, $stats->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">
    <values t="$t">
        <stat name="$name" value="$value" />
    </values>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, StatsInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'values' => [
                't' => $t,
                'stat' => [
                    [
                        'name' => $name,
                        'value' => $value,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stats, 'json'));
        $this->assertEquals($stats, $this->serializer->deserialize($json, StatsInfo::class, 'json'));
    }
}
