<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Common\Enum\AlwaysOnClusterBy;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for AlwaysOnClusterSelector.
 */
class AlwaysOnClusterSelectorTest extends ZimbraTestCase
{
    public function testAlwaysOnClusterSelector()
    {
        $value = $this->faker->word;
        $aoc = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID(), $value);
        $this->assertEquals(AlwaysOnClusterBy::ID(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $aoc = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID());
        $aoc->setBy(AlwaysOnClusterBy::NAME())
            ->setValue($value);
        $this->assertEquals(AlwaysOnClusterBy::NAME(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $by = AlwaysOnClusterBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result by="$by">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($aoc, 'xml'));
        $this->assertEquals($aoc, $this->serializer->deserialize($xml, AlwaysOnClusterSelector::class, 'xml'));
    }
}
