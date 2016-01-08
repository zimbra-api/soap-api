<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ByMonthRule;

/**
 * Testcase class for ByMonthRule.
 */
class ByMonthRuleTest extends ZimbraMailTestCase
{
    public function testByMonthRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(1, 12), $quantity);
        $list = implode(',', $numbers);

        $bymonth = new ByMonthRule($list);
        $this->assertSame($list, $bymonth->getList());
        $bymonth->setList($list);
        $this->assertSame($list, $bymonth->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bymonth molist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonth);

        $array = array(
            'bymonth' => array(
                'molist' => $list,
            ),
        );
        $this->assertEquals($array, $bymonth->toArray());
    }
}
