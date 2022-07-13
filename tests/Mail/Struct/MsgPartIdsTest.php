<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MsgPartIds;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgPartIds.
 */
class MsgPartIdsTest extends ZimbraTestCase
{
    public function testMsgPartIds()
    {
        $id = $this->faker->uuid;
        $partIds = $this->faker->word;

        $ids = new MsgPartIds(
            $id, $partIds
        );
        $this->assertSame($id, $ids->getId());
        $this->assertSame($partIds, $ids->getPartIds());

        $ids = new MsgPartIds();
        $ids->setId($id)
            ->setPartIds($partIds);
        $this->assertSame($id, $ids->getId());
        $this->assertSame($partIds, $ids->getPartIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" part="$partIds" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ids, 'xml'));
        $this->assertEquals($ids, $this->serializer->deserialize($xml, MsgPartIds::class, 'xml'));
    }
}
