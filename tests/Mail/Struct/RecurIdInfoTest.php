<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RecurIdInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RecurIdInfo.
 */
class RecurIdInfoTest extends ZimbraTestCase
{
    public function testRecurIdInfo()
    {
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $recurrenceId = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurIdZ = $this->faker->date;

        $recurId = new RecurIdInfo($recurrenceRangeType, $recurrenceId, $timezone, $recurIdZ);
        $this->assertSame($recurrenceRangeType, $recurId->getRecurrenceRangeType());
        $this->assertSame($recurrenceId, $recurId->getRecurrenceId());
        $this->assertSame($timezone, $recurId->getTimezone());
        $this->assertSame($recurIdZ, $recurId->getRecurIdZ());

        $recurId = new RecurIdInfo(0, '');
        $recurId->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId)
            ->setTimezone($timezone)
            ->setRecurIdZ($recurIdZ);
        $this->assertSame($recurrenceRangeType, $recurId->getRecurrenceRangeType());
        $this->assertSame($recurrenceId, $recurId->getRecurrenceId());
        $this->assertSame($timezone, $recurId->getTimezone());
        $this->assertSame($recurIdZ, $recurId->getRecurIdZ());

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($recurId, 'xml'));
        $this->assertEquals($recurId, $this->serializer->deserialize($xml, RecurIdInfo::class, 'xml'));

        $json = json_encode([
            'rangeType' => $recurrenceRangeType,
            'recurId' => $recurrenceId,
            'tz' => $timezone,
            'ridZ' => $recurIdZ,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($recurId, 'json'));
        $this->assertEquals($recurId, $this->serializer->deserialize($json, RecurIdInfo::class, 'json'));
    }
}
