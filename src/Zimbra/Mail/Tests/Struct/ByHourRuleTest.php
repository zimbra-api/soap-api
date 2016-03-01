<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ByHourRule;

/**
 * Testcase class for ByHourRule.
 */
class ByHourRuleTest extends ZimbraMailTestCase
{
    public function testByHourRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(0, 23), $quantity);
        $list = implode(',', $numbers);

        $byhour = new ByHourRule($list);
        $this->assertSame($list, $byhour->getList());
        $byhour->setList($list);
        $this->assertSame($list, $byhour->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<byhour hrlist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byhour);

        $array = array(
            'byhour' => array(
                'hrlist' => $list,
            ),
        );
        $this->assertEquals($array, $byhour->toArray());
    }
}
