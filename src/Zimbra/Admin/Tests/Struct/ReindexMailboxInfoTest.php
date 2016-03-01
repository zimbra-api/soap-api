<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ReindexMailboxInfo;
use Zimbra\Enum\ReindexType;

/**
 * Testcase class for ReindexMailboxInfo.
 */
class ReindexMailboxInfoTest extends ZimbraAdminTestCase
{
    public function testReindexMailboxInfo()
    {
        $id = $this->faker->word;
        $ids = $this->faker->word;
        $enums = $this->faker->randomElements(ReindexType::enums(), mt_rand(1, count(ReindexType::enums())));
        $types = implode(',', $enums);

        $mbox = new ReindexMailboxInfo($id, $types, $ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $mbox->setId($id)
             ->setTypes($types)
             ->setIds($ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
                'types' => $types,
                'ids' => $ids,
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }
}
