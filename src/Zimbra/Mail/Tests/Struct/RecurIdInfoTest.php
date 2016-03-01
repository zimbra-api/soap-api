<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\RecurIdInfo;

/**
 * Testcase class for RecurIdInfo.
 */
class RecurIdInfoTest extends ZimbraMailTestCase
{
    public function testRecurIdInfo()
    {
        $rangeType = mt_rand(1, 100);
        $recurId = $this->faker->iso8601;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $recur = new RecurIdInfo(
            $rangeType, $recurId, $tz, $ridZ
        );
        $this->assertSame($rangeType, $recur->getRecurrenceRangeType());
        $this->assertSame($recurId, $recur->getRecurrenceId());
        $this->assertSame($tz, $recur->getTimezone());
        $this->assertSame($ridZ, $recur->getRecurIdZ());

        $recur->setRecurrenceRangeType($rangeType)
              ->setRecurrenceId($recurId)
              ->setTimezone($tz)
              ->setRecurIdZ($ridZ);
        $this->assertSame($rangeType, $recur->getRecurrenceRangeType());
        $this->assertSame($recurId, $recur->getRecurrenceId());
        $this->assertSame($tz, $recur->getTimezone());
        $this->assertSame($ridZ, $recur->getRecurIdZ());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<recur rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'rangeType' => $rangeType,
                'recurId' => $recurId,
                'tz' => $tz,
                'ridZ' => $ridZ,
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }
}
