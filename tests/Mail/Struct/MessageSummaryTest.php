<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\MessageSummary;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessageSummary.
 */
class MessageSummaryTest extends ZimbraTestCase
{
    public function testMessageSummary()
    {
        $id = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $fragment = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO;
        $calItemType = InviteType::TASK;

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $invite = new InviteInfo($calItemType);

        $msg = new StubMessageSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame($invite, $msg->getInvite());

        $msg = new StubMessageSummary();
        $msg->setId($id)
            ->setAutoSendTime($autoSendTime)
            ->setEmails([$email])
            ->setSubject($subject)
            ->setFragment($fragment)
            ->setInvite($invite);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame($invite, $msg->getInvite());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" autoSendTime="$autoSendTime" xmlns:urn="urn:zimbraMail">
    <urn:e a="$address" d="$display" p="$personal" t="t" />
    <urn:su>$subject</urn:su>
    <urn:fr>$fragment</urn:fr>
    <urn:inv type="task" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubMessageSummary::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubMessageSummary extends MessageSummary
{
}
