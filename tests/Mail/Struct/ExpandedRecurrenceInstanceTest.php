<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ExpandedRecurrenceInstance;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandedRecurrenceInstance.
 */
class ExpandedRecurrenceInstanceTest extends ZimbraTestCase
{
    public function testExpandedRecurrenceInstance()
    {
        $startTime = $this->faker->unixTime;
        $duration = $this->faker->randomNumber;
        $tzOffset = $this->faker->randomNumber;
        $recurIdZ = $this->faker->iso8601;

        $inst = new ExpandedRecurrenceInstance($startTime, $duration, FALSE, $tzOffset, $recurIdZ);
        $this->assertSame($startTime, $inst->getStartTime());
        $this->assertSame($duration, $inst->getDuration());
        $this->assertFalse($inst->getAllDay());
        $this->assertSame($tzOffset, $inst->getTzOffset());
        $this->assertSame($recurIdZ, $inst->getRecurIdZ());

        $inst = new ExpandedRecurrenceInstance();
        $inst->setStartTime($startTime)
            ->setDuration($duration)
            ->setAllDay(TRUE)
            ->setTzOffset($tzOffset)
            ->setRecurIdZ($recurIdZ);
        $this->assertSame($startTime, $inst->getStartTime());
        $this->assertSame($duration, $inst->getDuration());
        $this->assertTrue($inst->getAllDay());
        $this->assertSame($tzOffset, $inst->getTzOffset());
        $this->assertSame($recurIdZ, $inst->getRecurIdZ());

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" dur="$duration" allDay="true" tzo="$tzOffset" ridZ="$recurIdZ" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inst, 'xml'));
        $this->assertEquals($inst, $this->serializer->deserialize($xml, ExpandedRecurrenceInstance::class, 'xml'));
    }
}
