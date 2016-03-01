<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SharedReminderMount;

/**
 * Testcase class for SharedReminderMount.
 */
class SharedReminderMountTest extends ZimbraMailTestCase
{
    public function testSharedReminderMount()
    {
        $id = $this->faker->uuid;
        $link = new SharedReminderMount(
            $id, true
        );
        $this->assertSame($id, $link->getId());
        $this->assertTrue($link->getShowReminders());

        $link = new SharedReminderMount('');
        $link->setId($id)
             ->setShowReminders(true);
        $this->assertSame($id, $link->getId());
        $this->assertTrue($link->getShowReminders());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<link id="' . $id . '" reminder="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $link);

        $array = array(
            'link' => array(
                'id' => $id,
                'reminder' => true,
            ),
        );
        $this->assertEquals($array, $link->toArray());
    }
}
