<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\BySecondRule;

/**
 * Testcase class for BySecondRule.
 */
class BySecondRuleTest extends ZimbraMailTestCase
{
    public function testBySecondRule()
    {
        $quantity = mt_rand(5, 10);
        $numbers = $this->faker->randomElements(range(0, 59), $quantity);
        $list = implode(',', $numbers);

        $bysecond = new BySecondRule($list);
        $this->assertSame($list, $bysecond->getList());
        $bysecond->setList($list);
        $this->assertSame($list, $bysecond->getList());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bysecond seclist="' . $list . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysecond);

        $array = array(
            'bysecond' => array(
                'seclist' => $list,
            ),
        );
        $this->assertEquals($array, $bysecond->toArray());
    }
}
