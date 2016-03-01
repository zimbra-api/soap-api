<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ExceptionRuleInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;

/**
 * Testcase class for ExceptionRuleInfo.
 */
class ExceptionRuleInfoTest extends ZimbraMailTestCase
{
    public function testExceptionRuleInfo()
    {
        $rangeType = mt_rand(1, 10);
        $recurId = $this->faker->iso8601;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;
        $add = new RecurrenceInfo();
        $exclude = new RecurrenceInfo();
        $except = new ExceptionRuleInfo(
            $rangeType, $recurId, $add, $exclude, $tz, $ridZ
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurIdInfo', $except);
        $this->assertSame($add, $except->getAdd());
        $this->assertSame($exclude, $except->getExclude());

        $except->setAdd($add)
               ->setExclude($exclude);
        $this->assertSame($add, $except->getAdd());
        $this->assertSame($exclude, $except->getExclude());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<except rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '">'
                .'<add />'
                .'<exclude />'
            .'</except>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $except);

        $array = array(
            'except' => array(
                'rangeType' => $rangeType,
                'recurId' => $recurId,
                'tz' => $tz,
                'ridZ' => $ridZ,
                'add' => array(),
                'exclude' => array(),
            ),
        );
        $this->assertEquals($array, $except->toArray());
    }
}
