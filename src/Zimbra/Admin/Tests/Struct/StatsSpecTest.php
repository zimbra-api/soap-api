<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for StatsSpec.
 */
class StatsSpecTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stats name="' . $name . '" limit="' . $limit . '">'
                . '<values>'
                    . '<stat name="' . $name . '" />'
                . '</values>'
            . '</stats>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));

        $stats = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\StatsSpec', 'xml');
        $values = $stats->getValues();
        $stat = $values->getStats()[0];

        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());
        $this->assertSame($name, $stat->getName());
    }
}
