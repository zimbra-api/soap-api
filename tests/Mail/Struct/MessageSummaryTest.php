<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\InviteType;

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
        $addressType = AddressType::TO();
        $calItemType = InviteType::TASK();

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $invite = new InviteInfo($calItemType);

        $msg = new MessageSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame($invite, $msg->getInvite());

        $msg = new MessageSummary('');
        $msg->setId($id)
            ->setAutoSendTime($autoSendTime)
            ->setEmails([$email])
            ->addEmail($email)
            ->setSubject($subject)
            ->setFragment($fragment)
            ->setInvite($invite);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());
        $this->assertSame([$email, $email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame($invite, $msg->getInvite());
        $msg->setEmails([$email]);

        $xml = <<<EOT
<?xml version="1.0"?>
<msg id="$id" autoSendTime="$autoSendTime">
    <e a="$address" d="$display" p="$personal" t="t" />
    <su>$subject</su>
    <fr>$fragment</fr>
    <inv type="task" />
</msg>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, MessageSummary::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'autoSendTime' => $autoSendTime,
            'e' => [
                [
                    'a' => $address,
                    'd' => $display,
                    'p' => $personal,
                    't' => 't',
                ],
            ],
            'su' => [
                '_content' => $subject,
            ],
            'fr' => [
                '_content' => $fragment,
            ],
            'inv' => [
                'type' => 'task',
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($msg, 'json'));
        $this->assertEquals($msg, $this->serializer->deserialize($json, MessageSummary::class, 'json'));
    }
}
