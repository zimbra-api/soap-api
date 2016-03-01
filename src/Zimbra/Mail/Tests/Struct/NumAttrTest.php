<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NumAttr;

/**
 * Testcase class for NumAttr.
 */
class NumAttrTest extends ZimbraMailTestCase
{
    public function testNumAttr()
    {
        $num = mt_rand(1, 100);
        $count = new NumAttr($num);
        $this->assertSame($num, $count->getNum());
        $count->setNum($num);
        $this->assertSame($num, $count->getNum());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<count num="' . $num . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $count);

        $array = array(
            'count' => array(
                'num' => $num,
            ),
        );
        $this->assertEquals($array, $count->toArray());
    }
}
