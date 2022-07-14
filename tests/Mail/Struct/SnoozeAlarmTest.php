<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\SnoozeAlarm;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SnoozeAlarm.
 */
class SnoozeAlarmTest extends ZimbraTestCase
{
    public function testSnoozeAlarm()
    {
        $id = $this->faker->uuid;
        $snoozeUntil = $this->faker->unixTime;

        $alarm = new SnoozeAlarm(
            $id, $snoozeUntil
        );
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($snoozeUntil, $alarm->getSnoozeUntil());

        $alarm = new SnoozeAlarm();
        $alarm->setId($id)
            ->setSnoozeUntil($snoozeUntil);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($snoozeUntil, $alarm->getSnoozeUntil());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" until="$snoozeUntil" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alarm, 'xml'));
        $this->assertEquals($alarm, $this->serializer->deserialize($xml, SnoozeAlarm::class, 'xml'));
    }
}
