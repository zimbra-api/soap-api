<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for StatsValueWrapper.
 */
class StatsValueWrapperTest extends ZimbraAdminTestCase
{
    public function testStatsValueWrapper()
    {
        $name1 = $this->faker->word;
        $name2 = $this->faker->word;
        $stat1 = new NamedElement($name1);
        $stat2 = new NamedElement($name2);

        $wrapper = new StatsValueWrapper([$stat1]);
        $this->assertSame([$stat1], $wrapper->getStats()->all());

        $wrapper->addStat($stat2);
        $this->assertSame([$stat1, $stat2], $wrapper->getStats()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<values>'
                . '<stat name="' . $name1 . '" />'
                . '<stat name="' . $name2 . '" />'
            . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wrapper);

        $array = [
            'values' => [
                'stat' => [
                    [
                        'name' => $name1,
                    ],
                    [
                        'name' => $name2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $wrapper->toArray());
    }
}
