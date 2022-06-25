<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InstanceRecurIdInfo.
 */
class InstanceRecurIdInfoTest extends ZimbraTestCase
{
    public function testInstanceRecurIdInfo()
    {
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;

        $inst = new InstanceRecurIdInfo($range, $dateTime, $timezone);
        $this->assertSame($range, $inst->getRange());
        $this->assertSame($dateTime, $inst->getDateTime());
        $this->assertSame($timezone, $inst->getTimezone());

        $inst = new InstanceRecurIdInfo();
        $inst->setRange($range)
            ->setDateTime($dateTime)
            ->setTimezone($timezone);
        $this->assertSame($range, $inst->getRange());
        $this->assertSame($dateTime, $inst->getDateTime());
        $this->assertSame($timezone, $inst->getTimezone());

        $xml = <<<EOT
<?xml version="1.0"?>
<result range="$range" d="$dateTime" tz="$timezone" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inst, 'xml'));
        $this->assertEquals($inst, $this->serializer->deserialize($xml, InstanceRecurIdInfo::class, 'xml'));
    }
}
