<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $values->addStat($stat2);
        $this->assertSame([$stat1, $stat2], $values->getStats());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<values>'
                . '<stat name="' . $name1 . '" />'
                . '<stat name="' . $name2 . '" />'
            . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));

        $values = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\StatsValueWrapper', 'xml');
        $stat1 = $values->getStats()[0];
        $stat2 = $values->getStats()[1];

        $this->assertSame($name1, $stat1->getName());
        $this->assertSame($name2, $stat2->getName());
    }
}
