<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\WildcardExpansionQueryInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WildcardExpansionQueryInfo.
 */
class WildcardExpansionQueryInfoTest extends ZimbraTestCase
{
    public function testWildcardExpansionQueryInfo()
    {
        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $wildcard = new WildcardExpansionQueryInfo($string, FALSE, $numExpanded);
        $this->assertSame($string, $wildcard->getStr());
        $this->assertFalse($wildcard->getExpanded());
        $this->assertSame($numExpanded, $wildcard->getNumExpanded());

        $wildcard = new WildcardExpansionQueryInfo();
        $wildcard->setStr($string)
            ->setExpanded(TRUE)
            ->setNumExpanded($numExpanded);
        $this->assertSame($string, $wildcard->getStr());
        $this->assertTrue($wildcard->getExpanded());
        $this->assertSame($numExpanded, $wildcard->getNumExpanded());

        $xml = <<<EOT
<?xml version="1.0"?>
<result str="$string" expanded="true" numExpanded="$numExpanded" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($wildcard, 'xml'));
        $this->assertEquals($wildcard, $this->serializer->deserialize($xml, WildcardExpansionQueryInfo::class, 'xml'));
    }
}
