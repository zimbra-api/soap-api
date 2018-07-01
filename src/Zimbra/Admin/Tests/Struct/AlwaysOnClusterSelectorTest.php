<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Enum\AlwaysOnClusterBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for AlwaysOnClusterSelector.
 */
class AlwaysOnClusterSelectorTest extends ZimbraStructTestCase
{
    public function testAlwaysOnClusterSelector()
    {
        $value = $this->faker->word;
        $aoc = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID()->value(), $value);
        $this->assertSame(AlwaysOnClusterBy::ID()->value(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $aoc = new AlwaysOnClusterSelector('');
        $aoc->setBy(AlwaysOnClusterBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(AlwaysOnClusterBy::NAME()->value(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<alwaysOnCluster by="' . AlwaysOnClusterBy::NAME() . '">' . $value . '</alwaysOnCluster>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($aoc, 'xml'));

        $aoc = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\AlwaysOnClusterSelector', 'xml');
        $this->assertSame(AlwaysOnClusterBy::NAME()->value(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());
    }
}
