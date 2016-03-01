<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ByMinuteRule;

/**
 * Testcase class for ByMinuteRule.
 */
class ByMinuteRuleTest extends ZimbraMailTestCase
{
    public function testByMinuteRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(0, 59), $quantity);
        $list = implode(',', $numbers);

        $byminute = new ByMinuteRule($list);
        $this->assertSame($list, $byminute->getList());
        $byminute->setList($list);
        $this->assertSame($list, $byminute->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<byminute minlist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byminute);

        $array = array(
            'byminute' => array(
                'minlist' => $list,
            ),
        );
        $this->assertEquals($array, $byminute->toArray());
    }
}
