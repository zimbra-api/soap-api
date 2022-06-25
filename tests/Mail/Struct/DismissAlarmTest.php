<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DismissAlarm;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DismissAlarmTest.
 */
class DismissAlarmTest extends ZimbraTestCase
{
    public function testDismissAlarm()
    {
        $id = $this->faker->uuid;
        $dismissedAt = $this->faker->randomNumber;

        $alarm = new DismissAlarm(
            $id, $dismissedAt
        );
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($dismissedAt, $alarm->getDismissedAt());

        $alarm = new DismissAlarm('', 0);
        $alarm->setId($id)
            ->setDismissedAt($dismissedAt);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($dismissedAt, $alarm->getDismissedAt());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" dismissedAt="$dismissedAt" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alarm, 'xml'));
        $this->assertEquals($alarm, $this->serializer->deserialize($xml, DismissAlarm::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'dismissedAt' => $dismissedAt,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($alarm, 'json'));
        $this->assertEquals($alarm, $this->serializer->deserialize($json, DismissAlarm::class, 'json'));
    }
}
