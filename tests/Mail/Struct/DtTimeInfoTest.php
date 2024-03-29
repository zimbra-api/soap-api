<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DtTimeInfo.
 */
class DtTimeInfoTest extends ZimbraTestCase
{
    public function testDtTimeInfo()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $utcTime = $this->faker->unixTime;

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
<result d="$dateTime" tz="$timezone" u="$utcTime" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dt, 'xml'));
        $this->assertEquals($dt, $this->serializer->deserialize($xml, DtTimeInfo::class, 'xml'));
    }
}
