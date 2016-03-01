<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\IntervalRule;

/**
 * Testcase class for IntervalRule.
 */
class IntervalRuleTest extends ZimbraMailTestCase
{
    public function testIntervalRule()
    {
        $ival = mt_rand(10, 100);
        $interval = new IntervalRule($ival);
        $this->assertSame($ival, $interval->getIval());
        $interval->setIval($ival);
        $this->assertSame($ival, $interval->getIval());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<interval ival="' . $ival . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $interval);

        $array = array(
            'interval' => array(
                'ival' => $ival,
            ),
        );
        $this->assertEquals($array, $interval->toArray());
    }
}
