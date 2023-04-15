<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NoteHitInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NoteHitInfo.
 */
class NoteHitInfoTest extends ZimbraTestCase
{
    public function testNoteHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;

        $hit = new NoteHitInfo($id, $sortField);
        $this->assertSame($sortField, $hit->getSortField());
        $hit = new NoteHitInfo($id);
        $hit->setSortField($sortField);
        $this->assertSame($sortField, $hit->getSortField());

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, NoteHitInfo::class, 'xml'));
    }
}
