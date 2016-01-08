<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ByMonthDayRule;

/**
 * Testcase class for ByMonthDayRule.
 */
class ByMonthDayRuleTest extends ZimbraMailTestCase
{
    public function testByMonthDayRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(1, 31), $quantity);
        $list = implode(',', $numbers);

        $bymonthday = new ByMonthDayRule($list);
        $this->assertSame($list, $bymonthday->getList());
        $bymonthday->setList($list);
        $this->assertSame($list, $bymonthday->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bymonthday modaylist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonthday);

        $array = array(
            'bymonthday' => array(
                'modaylist' => $list,
            ),
        );
        $this->assertEquals($array, $bymonthday->toArray());
    }
}
