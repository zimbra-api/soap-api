<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\InviteType;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\ChatSummary;
use Zimbra\Mail\Struct\MessageSummary;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ChatSummary.
 */
class ChatSummaryTest extends ZimbraTestCase
{
    public function testChatSummary()
    {
        $id = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $fragment = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::FROM();
        $calItemType = InviteType::TASK();

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $chat = new ChatSummary($id, $autoSendTime, [$email], $subject, $fragment, new InviteInfo($calItemType));
        $this->assertTrue($chat instanceof MessageSummary);

        $xml = <<<EOT
<?xml version="1.0"?>
<chat id="$id" autoSendTime="$autoSendTime">
    <e a="$address" d="$display" p="$personal" t="f" />
    <su>$subject</su>
    <fr>$fragment</fr>
    <inv type="task" />
</chat>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($chat, 'xml'));
        $this->assertEquals($chat, $this->serializer->deserialize($xml, ChatSummary::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'autoSendTime' => $autoSendTime,
            'e' => [
                [
                    'a' => $address,
                    'd' => $display,
                    'p' => $personal,
                    't' => 'f',
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($chat, 'json'));
        $this->assertEquals($chat, $this->serializer->deserialize($json, ChatSummary::class, 'json'));
    }
}