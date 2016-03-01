<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for StatsSpec.
 */
class StatsSpecTest extends ZimbraAdminTestCase
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

        $stats->setValues($values)
              ->setName($name)
              ->setLimit($limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stats name="' . $name . '" limit="' . $limit . '">'
                . '<values>'
                    . '<stat name="' . $name . '" />'
                . '</values>'
            . '</stats>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stats);

        $array = [
            'stats' => [
                'name' => $name,
                'limit' => $limit,
                'values' => [
                    'stat' => [
                        [
                            'name' => $name
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $stats->toArray());
    }
}
