<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\Notification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Notification.
 */
class NotificationTest extends ZimbraTestCase
{
    public function testNotification()
    {
        $content = $this->faker->text;

        $notification = new StubNotification(FALSE, $content);
        $this->assertFalse($notification->getTruncatedContent());
        $this->assertSame($content, $notification->getContent());

        $notification = new StubNotification();
        $notification->setTruncatedContent(TRUE)
            ->setContent($content);
        $this->assertTrue($notification->getTruncatedContent());
        $this->assertSame($content, $notification->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result truncated="true" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($notification, 'xml'));
        $this->assertEquals($notification, $this->serializer->deserialize($xml, StubNotification::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubNotification extends Notification
{
}
