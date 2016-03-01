<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;

/**
 * Testcase class for InstanceRecurIdInfo.
 */
class InstanceRecurIdInfoTest extends ZimbraMailTestCase
{
    public function testInstanceRecurIdInfo()
    {
        $range = $this->faker->word;
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;

        $inst = new InstanceRecurIdInfo(
            $range, $date, $tz
        );
        $this->assertSame($range, $inst->getRange());
        $this->assertSame($date, $inst->getDateTime());
        $this->assertSame($tz, $inst->getTimezone());

        $inst->setRange($range)
             ->setDateTime($date)
             ->setTimezone($tz);
        $this->assertSame($range, $inst->getRange());
        $this->assertSame($date, $inst->getDateTime());
        $this->assertSame($tz, $inst->getTimezone());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<inst range="' . $range . '" d="' . $date . '" tz="' . $tz . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inst);

        $array = array(
            'inst' => array(
                'range' => $range,
                'd' => $date,
                'tz' => $tz,
            ),
        );
        $this->assertEquals($array, $inst->toArray());
    }
}
