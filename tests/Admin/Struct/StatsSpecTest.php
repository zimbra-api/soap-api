<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StatsSpec.
 */
class StatsSpecTest extends ZimbraTestCase
{
    public function testStatsSpec()
    {
        $name = $this->faker->word;
        $limit = $this->faker->word;

        $stat = new NamedElement($name);
        $values = new StatsValueWrapper([$stat]);

        $stats = new StatsSpec($values, $name, $limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $stats = new StatsSpec(new StatsValueWrapper());
        $stats->setValues($values)
              ->setName($name)
              ->setLimit($limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" limit="$limit">
    <values>
        <stat name="$name" />
    </values>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, StatsSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'limit' => $limit,
            'values' => [
                'stat' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stats, 'json'));
        $this->assertEquals($stats, $this->serializer->deserialize($json, StatsSpec::class, 'json'));
    }
}
