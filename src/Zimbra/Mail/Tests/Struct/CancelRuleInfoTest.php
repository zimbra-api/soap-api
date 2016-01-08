<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CancelRuleInfo;

/**
 * Testcase class for CancelRuleInfo.
 */
class CancelRuleInfoTest extends ZimbraMailTestCase
{
    public function testCancelRuleInfo()
    {
        $rangeType = mt_rand(1, 100);
        $recurId = $this->faker->iso8601;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $cancel = new CancelRuleInfo(
            $rangeType, $recurId, $tz, $ridZ
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurIdInfo', $cancel);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cancel rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cancel);

        $array = array(
            'cancel' => array(
                'rangeType' => $rangeType,
                'recurId' => $recurId,
                'tz' => $tz,
                'ridZ' => $ridZ,
            ),
        );
        $this->assertEquals($array, $cancel->toArray());
    }
}
