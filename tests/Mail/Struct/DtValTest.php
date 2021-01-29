<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DtVal;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DtVal.
 */
class DtValTest extends ZimbraTestCase
{
    public function testDtVal()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $utcTime = time();
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $startTime = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $endTime = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);

        $dtval = new DtVal(
            $startTime, $endTime, $duration
        );
        $this->assertSame($startTime, $dtval->getStartTime());
        $this->assertSame($endTime, $dtval->getEndTime());
        $this->assertSame($duration, $dtval->getDuration());

        $dtval = new DtVal();
        $dtval->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setDuration($duration);
        $this->assertSame($startTime, $dtval->getStartTime());
        $this->assertSame($endTime, $dtval->getEndTime());
        $this->assertSame($duration, $dtval->getDuration());

        $xml = <<<EOT
<?xml version="1.0"?>
<dtval>
    <s d="$dateTime" tz="$timezone" u="$utcTime" />
    <e d="$dateTime" tz="$timezone" u="$utcTime" />
    <dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</dtval>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dtval, 'xml'));
        $this->assertEquals($dtval, $this->serializer->deserialize($xml, DtVal::class, 'xml'));

        $json = json_encode([
            's' => [
                'd' => $dateTime,
                'tz' => $timezone,
                'u' => $utcTime,
            ],
            'e' => [
                'd' => $dateTime,
                'tz' => $timezone,
                'u' => $utcTime,
            ],
            'dur' => [
                'w' => $weeks,
                'd' => $days,
                'h' => $hours,
                'm' => $minutes,
                's' => $seconds,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dtval, 'json'));
        $this->assertEquals($dtval, $this->serializer->deserialize($json, DtVal::class, 'json'));
    }
}
