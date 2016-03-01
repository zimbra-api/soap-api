<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\IdsAttr;

/**
 * Testcase class for IdsAttr.
 */
class IdsAttrTest extends ZimbraMailTestCase
{
    public function testIdsAttr()
    {
        $ids = $this->faker->word;
        $m = new IdsAttr($ids);
        $this->assertSame($ids, $m->getIds());

        $m->setIds($ids);
        $this->assertSame($ids, $m->getIds());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m ids="' . $ids . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'ids' => $ids,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
