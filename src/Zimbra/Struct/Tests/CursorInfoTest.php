<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\CursorInfo;

/**
 * Testcase class for CursorInfo.
 */
class CursorInfoTest extends ZimbraStructTestCase
{
    public function testCursorInfo()
    {
        $id = $this->faker->word;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $cursor = new CursorInfo($id,$sortVal, $endSortVal, false);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertFalse($cursor->getIncludeOffset());

        $cursor = new CursorInfo();
        $cursor->setId($id)
               ->setSortVal($sortVal)
               ->setEndSortVal($endSortVal)
               ->setIncludeOffset(true);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertTrue($cursor->getIncludeOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cursor, 'xml'));

        $cursor = $this->serializer->deserialize($xml, 'Zimbra\Struct\CursorInfo', 'xml');
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertTrue($cursor->getIncludeOffset());
    }
}
