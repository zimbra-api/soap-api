<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ReindexMailboxInfo;
use Zimbra\Common\Enum\ReindexType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ReindexMailboxInfo.
 */
class ReindexMailboxInfoTest extends ZimbraTestCase
{
    public function testReindexMailboxInfo()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = array_map(static fn ($enum) => $enum->value, ReindexType::cases());
        $enums = $this->faker->randomElements($enums, mt_rand(1, count($enums)));
        $types = implode(',', $enums);

        $mbox = new ReindexMailboxInfo($id, $types, $ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $mbox = new ReindexMailboxInfo();
        $mbox->setId($id)
             ->setTypes($types)
             ->setIds($ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" types="$types" ids="$ids" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, ReindexMailboxInfo::class, 'xml'));
    }
}
