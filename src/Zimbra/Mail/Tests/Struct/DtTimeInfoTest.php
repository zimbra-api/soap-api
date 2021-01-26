<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DtTimeInfo.
 */
class DtTimeInfoTest extends ZimbraStructTestCase
{
    public function testDtTimeInfo()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $utcTime = time();

        $dt = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $this->assertSame($dateTime, $dt->getDateTime());
        $this->assertSame($timezone, $dt->getTimezone());
        $this->assertSame($utcTime, $dt->getUtcTime());

        $dt = new DtTimeInfo();
        $dt->setDateTime($dateTime)
            ->setTimezone($timezone)
            ->setUtcTime($utcTime);
        $this->assertSame($dateTime, $dt->getDateTime());
        $this->assertSame($timezone, $dt->getTimezone());
        $this->assertSame($utcTime, $dt->getUtcTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<dt d="$dateTime" tz="$timezone" u="$utcTime" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dt, 'xml'));
        $this->assertEquals($dt, $this->serializer->deserialize($xml, DtTimeInfo::class, 'xml'));

        $json = json_encode([
            'd' => $dateTime,
            'tz' => $timezone,
            'u' => $utcTime,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dt, 'json'));
        $this->assertEquals($dt, $this->serializer->deserialize($json, DtTimeInfo::class, 'json'));
    }
}
