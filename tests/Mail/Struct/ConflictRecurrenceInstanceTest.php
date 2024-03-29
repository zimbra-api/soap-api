<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\FreeBusyStatus;
use Zimbra\Mail\Struct\ConflictRecurrenceInstance;
use Zimbra\Mail\Struct\FreeBusyUserStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConflictRecurrenceInstance.
 */
class ConflictRecurrenceInstanceTest extends ZimbraTestCase
{
    public function testConflictRecurrenceInstance()
    {
        $name = $this->faker->email;
        $startTime = $this->faker->unixTime;
        $duration = $this->faker->randomNumber;
        $tzOffset = $this->faker->randomNumber;
        $recurIdZ = $this->faker->iso8601;

        $freebusyUser = new FreeBusyUserStatus($name, FreeBusyStatus::FREE);

        $inst = new StubConflictRecurrenceInstance([$freebusyUser]);
        $this->assertSame([$freebusyUser], $inst->getFreebusyUsers());

        $inst = new StubConflictRecurrenceInstance();
        $inst->setFreebusyUsers([$freebusyUser]);
        $this->assertSame([$freebusyUser], $inst->getFreebusyUsers());
        $inst->setStartTime($startTime)
            ->setDuration($duration)
            ->setAllDay(TRUE)
            ->setTzOffset($tzOffset)
            ->setRecurIdZ($recurIdZ)
            ->setFreebusyUsers([$freebusyUser]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" dur="$duration" allDay="true" tzo="$tzOffset" ridZ="$recurIdZ" xmlns:urn="urn:zimbraMail">
    <urn:usr name="$name" fb="F" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inst, 'xml'));
        $this->assertEquals($inst, $this->serializer->deserialize($xml, StubConflictRecurrenceInstance::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubConflictRecurrenceInstance extends ConflictRecurrenceInstance
{
}
