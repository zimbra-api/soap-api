<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ParentId;

/**
 * Testcase class for ParentId.
 */
class ParentIdTest extends ZimbraMailTestCase
{
    public function testParentId()
    {
        $id = $this->faker->uuid;
        $parent = new ParentId(
            $id
        );
        $this->assertSame($id, $parent->getParentId());

        $parent = new ParentId('');
        $parent->setParentId($id);
        $this->assertSame($id, $parent->getParentId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<parent parentId="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $parent);

        $array = array(
            'parent' => array(
                'parentId' => $id,
            ),
        );
        $this->assertEquals($array, $parent->toArray());
    }
}
