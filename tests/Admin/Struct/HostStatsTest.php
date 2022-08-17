<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\HostStats;
use Zimbra\Admin\Struct\StatsInfo;
use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HostStats.
 */
class HostStatsTest extends ZimbraTestCase
{
    public function testHostStats()
    {
        $hostName = $this->faker->word;
        $t = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $stats = new StatsInfo($name, new StatsValues($t, [new NameAndValue($name, $value)]));

        $hostname = new StubHostStats($hostName, $stats);
        $this->assertSame($hostName, $hostname->getHostName());
        $this->assertSame($stats, $hostname->getStats());

        $hostname = new StubHostStats();
        $hostname->setHostName($hostName)
             ->setStats($stats);
        $this->assertSame($hostName, $hostname->getHostName());
        $this->assertSame($stats, $hostname->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<result hn="$hostName" xmlns:urn="urn:zimbraAdmin">
    <urn:stats name="$name">
        <urn:values t="$t">
            <urn:stat name="$name" value="$value" />
        </urn:values>
    </urn:stats>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hostname, 'xml'));
        $this->assertEquals($hostname, $this->serializer->deserialize($xml, StubHostStats::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubHostStats extends HostStats
{
}
