<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Mail\Struct\ByYearDayRule;

/**
 * Testcase class for ByYearDayRule.
 */
class ByYearDayRuleTest extends ZimbraMailTestCase
{
    public function testByYearDayRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(1, 366), $quantity);
        $list = implode(',', $numbers);

        $byyearday = new ByYearDayRule($list);
        $this->assertSame($list, $byyearday->getList());
        $byyearday->setList($list);
        $this->assertSame($list, $byyearday->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<byyearday yrdaylist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byyearday);

        $array = array(
            'byyearday' => array(
                'yrdaylist' => $list,
            ),
        );
        $this->assertEquals($array, $byyearday->toArray());
    }
}
