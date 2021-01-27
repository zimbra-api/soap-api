<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ExceptionRecurIdInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ExceptionRecurIdInfo.
 */
class ExceptionRecurIdInfoTest extends ZimbraStructTestCase
{
    public function testExceptionRecurIdInfo()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = mt_rand(1, 3);

        $exceptId = new ExceptionRecurIdInfo($dateTime, $timezone, $recurrenceRangeType);
        $this->assertSame($recurrenceRangeType, $exceptId->getRecurrenceRangeType());
        $this->assertSame($dateTime, $exceptId->getDateTime());
        $this->assertSame($timezone, $exceptId->getTimezone());

        $exceptId = new ExceptionRecurIdInfo('');
        $exceptId->setRecurrenceRangeType($recurrenceRangeType)
            ->setDateTime($dateTime)
            ->setTimezone($timezone);
        $this->assertSame($recurrenceRangeType, $exceptId->getRecurrenceRangeType());
        $this->assertSame($dateTime, $exceptId->getDateTime());
        $this->assertSame($timezone, $exceptId->getTimezone());

        $xml = <<<EOT
<?xml version="1.0"?>
<exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($exceptId, 'xml'));
        $this->assertEquals($exceptId, $this->serializer->deserialize($xml, ExceptionRecurIdInfo::class, 'xml'));

        $json = json_encode([
            'd' => $dateTime,
            'tz' => $timezone,
            'rangeType' => $recurrenceRangeType,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($exceptId, 'json'));
        $this->assertEquals($exceptId, $this->serializer->deserialize($json, ExceptionRecurIdInfo::class, 'json'));
    }
}
