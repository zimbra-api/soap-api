<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $notification = new Notification(FALSE, $content);
        $this->assertFalse($notification->getTruncatedContent());
        $this->assertSame($content, $notification->getContent());

        $notification = new Notification();
        $notification->setTruncatedContent(TRUE)
            ->setContent($content);
        $this->assertTrue($notification->getTruncatedContent());
        $this->assertSame($content, $notification->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<notification truncated="true">
    <content>$content</content>
</notification>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($notification, 'xml'));
        $this->assertEquals($notification, $this->serializer->deserialize($xml, Notification::class, 'xml'));

        $json = json_encode([
            'truncated' => TRUE,
            'content' => [
                '_content' => $content,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($notification, 'json'));
        $this->assertEquals($notification, $this->serializer->deserialize($json, Notification::class, 'json'));
    }
}