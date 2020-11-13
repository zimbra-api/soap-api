<?php declare(strict_types=1);

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
        $aoc = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID(), $value);
        $this->assertEquals(AlwaysOnClusterBy::ID(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $aoc = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID());
        $aoc->setBy(AlwaysOnClusterBy::NAME())
            ->setValue($value);
        $this->assertEquals(AlwaysOnClusterBy::NAME(), $aoc->getBy());
        $this->assertSame($value, $aoc->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<alwaysOnCluster by="' . AlwaysOnClusterBy::NAME() . '">' . $value . '</alwaysOnCluster>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($aoc, 'xml'));
        $this->assertEquals($aoc, $this->serializer->deserialize($xml, AlwaysOnClusterSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) AlwaysOnClusterBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($aoc, 'json'));
        $this->assertEquals($aoc, $this->serializer->deserialize($json, AlwaysOnClusterSelector::class, 'json'));
    }
}
