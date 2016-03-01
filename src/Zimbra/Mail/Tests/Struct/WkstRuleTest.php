<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\WkstRule;

/**
 * Testcase class for WkstRule.
 */
class WkstRuleTest extends ZimbraMailTestCase
{
    public function testWkstRule()
    {
        $wkst = new WkstRule(WeekDay::MO());
        $this->assertSame('MO', (string) $wkst->getDay());

        $wkst->setDay(WeekDay::SU());
        $this->assertSame('SU', (string) $wkst->getDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<wkst day="' . WeekDay::SU() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkst);

        $array = array(
            'wkst' => array(
                'day' => WeekDay::SU()->value(),
            ),
        );
        $this->assertEquals($array, $wkst->toArray());
    }
}
