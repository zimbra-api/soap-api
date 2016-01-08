<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Enum\RangeType;
use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ExceptionRecurIdInfo;

/**
 * Testcase class for ExceptionRecurIdInfo.
 */
class ExceptionRecurIdInfoTest extends ZimbraMailTestCase
{
    public function testExceptionRecurIdInfo()
    {
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;

        $exceptId = new ExceptionRecurIdInfo(
            $date, $tz, RangeType::THISANDFUTURE()
        );
        $this->assertSame($date, $exceptId->getDateTime());
        $this->assertSame($tz, $exceptId->getTimezone());
        $this->assertSame(2, $exceptId->getRangeType()->value());

        $exceptId->setDateTime($date)
                 ->setTimezone($tz)
                 ->setRangeType(RangeType::NONE());
        $this->assertSame($date, $exceptId->getDateTime());
        $this->assertSame($tz, $exceptId->getTimezone());
        $this->assertSame(-1, $exceptId->getRangeType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<exceptId d="' . $date . '" tz="' . $tz . '" rangeType="' . RangeType::NONE() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exceptId);

        $array = array(
            'exceptId' => array(
                'd' => $date,
                'tz' => $tz,
                'rangeType' => RangeType::NONE()->value(),
            ),
        );
        $this->assertEquals($array, $exceptId->toArray());
    }
}
