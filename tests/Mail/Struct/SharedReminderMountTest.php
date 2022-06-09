<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\SharedReminderMount;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SharedReminderMountTest.
 */
class SharedReminderMountTest extends ZimbraTestCase
{
    public function testSharedReminderMount()
    {
        $id = $this->faker->uuid;

        $mount = new SharedReminderMount(
            $id, FALSE
        );
        $this->assertSame($id, $mount->getId());
        $this->assertFalse($mount->getShowReminders());

        $mount = new SharedReminderMount('');
        $mount->setId($id)
              ->setShowReminders(TRUE);
        $this->assertSame($id, $mount->getId());
        $this->assertTrue($mount->getShowReminders());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" reminder="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mount, 'xml'));
        $this->assertEquals($mount, $this->serializer->deserialize($xml, SharedReminderMount::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'reminder' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mount, 'json'));
        $this->assertEquals($mount, $this->serializer->deserialize($json, SharedReminderMount::class, 'json'));
    }
}
