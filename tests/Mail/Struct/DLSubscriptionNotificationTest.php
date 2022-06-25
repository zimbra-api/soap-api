<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\Notification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DLSubscriptionNotification.
 */
class DLSubscriptionNotificationTest extends ZimbraTestCase
{
    public function testDLSubscriptionNotification()
    {
        $content = $this->faker->text;

        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $this->assertTrue($dlSubs instanceof Notification);

        $xml = <<<EOT
<?xml version="1.0"?>
<result truncated="true">
    <content>$content</content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dlSubs, 'xml'));
        $this->assertEquals($dlSubs, $this->serializer->deserialize($xml, DLSubscriptionNotification::class, 'xml'));
    }
}
