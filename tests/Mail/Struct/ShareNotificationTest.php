<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Notification;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ShareNotification.
 */
class ShareNotificationTest extends ZimbraTestCase
{
    public function testShareNotification()
    {
        $content = $this->faker->text;

        $shr = new ShareNotification(TRUE, $content);
        $this->assertTrue($shr instanceof Notification);

        $xml = <<<EOT
<?xml version="1.0"?>
<shr truncated="true">
    <content>$content</content>
</shr>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($shr, 'xml'));
        $this->assertEquals($shr, $this->serializer->deserialize($xml, ShareNotification::class, 'xml'));

        $json = json_encode([
            'truncated' => TRUE,
            'content' => [
                '_content' => $content,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($shr, 'json'));
        $this->assertEquals($shr, $this->serializer->deserialize($json, ShareNotification::class, 'json'));
    }
}