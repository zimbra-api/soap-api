<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\RecurIdInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RecurIdInfo.
 */
class RecurIdInfoTest extends ZimbraStructTestCase
{
    public function testRecurIdInfo()
    {
        $recurrenceRangeType = mt_rand(1, 100);
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
<recurId rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
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
