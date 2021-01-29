<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ReindexMailboxInfo;
use Zimbra\Enum\ReindexType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ReindexMailboxInfo.
 */
class ReindexMailboxInfoTest extends ZimbraStructTestCase
{
    public function testReindexMailboxInfo()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = $this->faker->randomElements(ReindexType::toArray(), mt_rand(1, count(ReindexType::toArray())));
        $types = implode(',', $enums);

        $mbox = new ReindexMailboxInfo($id, $types, $ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $mbox = new ReindexMailboxInfo('');
        $mbox->setId($id)
             ->setTypes($types)
             ->setIds($ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<mbox id="$id" types="$types" ids="$ids" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, ReindexMailboxInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'types' => $types,
            'ids' => $ids,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, ReindexMailboxInfo::class, 'json'));
    }
}
