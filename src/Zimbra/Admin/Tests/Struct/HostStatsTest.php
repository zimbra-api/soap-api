<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\HostStats;
use Zimbra\Admin\Struct\StatsInfo;
use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for HostStats.
 */
class HostStatsTest extends ZimbraStructTestCase
{
    public function testHostStats()
    {
        $hostName = $this->faker->word;
        $t = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $stats = new StatsInfo($name, new StatsValues($t, [new NameAndValue($name, $value)]));

        $hostname = new HostStats($hostName, $stats);
        $this->assertSame($hostName, $hostname->getHostName());
        $this->assertSame($stats, $hostname->getStats());

        $hostname = new HostStats('');
        $hostname->setHostName($hostName)
             ->setStats($stats);
        $this->assertSame($hostName, $hostname->getHostName());
        $this->assertSame($stats, $hostname->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<hostname hn="$hostName">
    <stats name="$name">
        <values t="$t">
            <stat name="$name" value="$value" />
        </values>
    </stats>
</hostname>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hostname, 'xml'));
        $this->assertEquals($hostname, $this->serializer->deserialize($xml, HostStats::class, 'xml'));

        $json = json_encode([
            'hn' => $hostName,
            'stats' => [
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($hostname, 'json'));
        $this->assertEquals($hostname, $this->serializer->deserialize($json, HostStats::class, 'json'));
    }
}
