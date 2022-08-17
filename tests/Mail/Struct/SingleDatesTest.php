<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\DtVal;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\SingleDates;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SingleDates.
 */
class SingleDatesTest extends ZimbraTestCase
{
    public function testSingleDates()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $utcTime = time();
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $dtVal = new DtVal(
            new DtTimeInfo($dateTime, $timezone, $utcTime),
            new DtTimeInfo($dateTime, $timezone, $utcTime),
            new DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );

        $dates = new StubSingleDates(
            $timezone, [$dtVal]
        );
        $this->assertSame($timezone, $dates->getTimezone());
        $this->assertSame([$dtVal], $dates->getDtVals());

        $dates = new StubSingleDates();
        $dates->setTimezone($timezone)
            ->setDtVals([$dtVal])
            ->addDtVal($dtVal);
        $this->assertSame($timezone, $dates->getTimezone());
        $this->assertSame([$dtVal, $dtVal], $dates->getDtVals());
        $dates->setDtVals([$dtVal]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result tz="$timezone" xmlns:urn="urn:zimbraMail">
    <urn:dtval>
        <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
        <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
        <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
    </urn:dtval>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dates, 'xml'));
        $this->assertEquals($dates, $this->serializer->deserialize($xml, StubSingleDates::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubSingleDates extends SingleDates
{
}
