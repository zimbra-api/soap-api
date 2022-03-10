<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Struct\CursorInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CursorInfo.
 */
class CursorInfoTest extends ZimbraTestCase
{
    public function testCursorInfo()
    {
        $id = $this->faker->uuid;
        $sortVal = $this->faker->word;
        $endSortVal = $this->faker->word;

        $cursor = new CursorInfo($id, $sortVal, $endSortVal, FALSE);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertFalse($cursor->getIncludeOffset());

        $cursor = new CursorInfo();
        $cursor->setId($id)
               ->setSortVal($sortVal)
               ->setEndSortVal($endSortVal)
               ->setIncludeOffset(TRUE);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertTrue($cursor->getIncludeOffset());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" sortVal="$sortVal" endSortVal="$endSortVal" includeOffset="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cursor, 'xml'));
        $this->assertEquals($cursor, $this->serializer->deserialize($xml, CursorInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'sortVal' => $sortVal,
            'endSortVal' => $endSortVal,
            'includeOffset' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cursor, 'json'));
        $this->assertEquals($cursor, $this->serializer->deserialize($json, CursorInfo::class, 'json'));
    }
}
