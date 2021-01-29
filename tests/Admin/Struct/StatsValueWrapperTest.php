<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for StatsValueWrapper.
 */
class StatsValueWrapperTest extends ZimbraStructTestCase
{
    public function testStatsValueWrapper()
    {
        $name1 = $this->faker->word;
        $name2 = $this->faker->word;

        $stat1 = new NamedElement($name1);
        $stat2 = new NamedElement($name2);

        $values = new StatsValueWrapper([$stat1]);
        $this->assertSame([$stat1], $values->getStats());

        $values = new StatsValueWrapper();
        $values->setStats([$stat1])
             ->addStat($stat2);
        $this->assertSame([$stat1, $stat2], $values->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<values>
    <stat name="$name1" />
    <stat name="$name2" />
</values>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));
        $this->assertEquals($values, $this->serializer->deserialize($xml, StatsValueWrapper::class, 'xml'));

        $json = json_encode([
            'stat' => [
                [
                    'name' => $name1,
                ],
                [
                    'name' => $name2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($values, 'json'));
        $this->assertEquals($values, $this->serializer->deserialize($json, StatsValueWrapper::class, 'json'));
    }
}
