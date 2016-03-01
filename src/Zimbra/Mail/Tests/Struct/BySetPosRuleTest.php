<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\BySetPosRule;

/**
 * Testcase class for BySetPosRule.
 */
class BySetPosRuleTest extends ZimbraMailTestCase
{
    public function testBySetPosRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(1, 366), $quantity);
        $list = implode(',', $numbers);

        $bysetpos = new BySetPosRule($list);
        $this->assertSame($list, $bysetpos->getList());
        $bysetpos->setList($list);
        $this->assertSame($list, $bysetpos->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bysetpos poslist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysetpos);

        $array = array(
            'bysetpos' => array(
                'poslist' => $list,
            ),
        );
        $this->assertEquals($array, $bysetpos->toArray());
    }
}
