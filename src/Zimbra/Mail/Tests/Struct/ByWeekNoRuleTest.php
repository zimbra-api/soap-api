<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Mail\Struct\ByWeekNoRule;

/**
 * Testcase class for ByWeekNoRule.
 */
class ByWeekNoRuleTest extends ZimbraMailTestCase
{
    public function testByWeekNoRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(1, 53), $quantity);
        $list = implode(',', $numbers);

        $byweekno = new ByWeekNoRule($list);
        $this->assertSame($list, $byweekno->getList());
        $byweekno->setList($list);
        $this->assertSame($list, $byweekno->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<byweekno wklist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byweekno);

        $array = array(
            'byweekno' => array(
                'wklist' => $list,
            ),
        );
        $this->assertEquals($array, $byweekno->toArray());
    }
}
