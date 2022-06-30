<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $dtval = new StubDtVal(
            $startTime, $endTime, $duration
        );
        $this->assertSame($startTime, $dtval->getStartTime());
        $this->assertSame($endTime, $dtval->getEndTime());
        $this->assertSame($duration, $dtval->getDuration());

        $dtval = new StubDtVal();
        $dtval->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setDuration($duration);
        $this->assertSame($startTime, $dtval->getStartTime());
        $this->assertSame($endTime, $dtval->getEndTime());
        $this->assertSame($duration, $dtval->getDuration());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dtval, 'xml'));
        $this->assertEquals($dtval, $this->serializer->deserialize($xml, StubDtVal::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubDtVal extends DtVal
{
}
