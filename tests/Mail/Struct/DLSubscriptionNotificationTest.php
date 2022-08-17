<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $dlSubs = new StubDLSubscriptionNotification(TRUE, $content);
        $this->assertTrue($dlSubs instanceof Notification);

        $xml = <<<EOT
<?xml version="1.0"?>
<result truncated="true" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dlSubs, 'xml'));
        $this->assertEquals($dlSubs, $this->serializer->deserialize($xml, StubDLSubscriptionNotification::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubDLSubscriptionNotification extends DLSubscriptionNotification
{
}
