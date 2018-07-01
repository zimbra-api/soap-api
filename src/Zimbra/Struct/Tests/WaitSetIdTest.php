<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\Id;
use Zimbra\Struct\WaitSetId;

/**
 * Testcase class for WaitSetId.
 */
class WaitSetIdTest extends ZimbraStructTestCase
{
    public function testWaitSetId()
    {
        $id1 = $this->faker->uuid;
        $a1 = new Id($id1);
        $id2 = $this->faker->uuid;
        $a2 = new Id($id2);

        $remove = new WaitSetId([$a1]);
        $this->assertSame([$a1], $remove->getIds());
        $remove->addId($a2);
        $this->assertSame([$a1, $a2], $remove->getIds());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<remove>'
                .'<a id="' . $id1 . '" />'
                .'<a id="' . $id2 . '" />'
            .'</remove>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($remove, 'xml'));

        $remove = $this->serializer->deserialize($xml, 'Zimbra\Struct\WaitSetId', 'xml');
        $ids = $remove->getIds();

        $a1 = $ids[0];
        $this->assertSame($id1, $a1->getId());

        $a2 = $ids[1];
        $this->assertSame($id2, $a2->getId());
    }
}
