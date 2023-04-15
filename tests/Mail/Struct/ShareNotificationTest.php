<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $shr = new StubShareNotification(TRUE, $content);
        $this->assertTrue($shr instanceof Notification);

        $xml = <<<EOT
<?xml version="1.0"?>
<result truncated="true" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($shr, 'xml'));
        $this->assertEquals($shr, $this->serializer->deserialize($xml, StubShareNotification::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubShareNotification extends ShareNotification
{
}
