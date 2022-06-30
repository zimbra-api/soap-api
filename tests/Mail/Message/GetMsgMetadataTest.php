<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Message\GetMsgMetadataEnvelope;
use Zimbra\Mail\Message\GetMsgMetadataBody;
use Zimbra\Mail\Message\GetMsgMetadataRequest;
use Zimbra\Mail\Message\GetMsgMetadataResponse;

use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Mail\Struct\AddMsgSpec;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\ChatSummary;
use Zimbra\Mail\Struct\MessageSummary;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMsgMetadata.
 */
class GetMsgMetadataTest extends ZimbraTestCase
{
    public function testGetMsgMetadata()
    {
        $ids = implode(',', [
            $this->faker->uuid,
            $this->faker->uuid,
        ]);
        $msgIds = new IdsAttr($ids);

        $request = new GetMsgMetadataRequest($msgIds);
        $this->assertSame($msgIds, $request->getMsgIds());
        $request = new GetMsgMetadataRequest(new IdsAttr(''));
        $request->setMsgIds($msgIds);
        $this->assertSame($msgIds, $request->getMsgIds());

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
        $chat = new ChatSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);
        $msg = new MessageSummary($id, $autoSendTime, [$email], $subject, $fragment, $invite);

        $response = new GetMsgMetadataResponse([$chat], [$msg]);
        $this->assertSame([$chat], $response->getChatMessages());
        $this->assertSame([$msg], $response->getMsgMessages());
        $response = new GetMsgMetadataResponse();
        $response->setChatMessages([$chat])
            ->addChatMessage($chat)
            ->setMsgMessages([$msg])
            ->addMsgMessage($msg);
        $this->assertSame([$chat, $chat], $response->getChatMessages());
        $this->assertSame([$msg, $msg], $response->getMsgMessages());
        $response = new GetMsgMetadataResponse([$chat], [$msg]);

        $body = new GetMsgMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetMsgMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMsgMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetMsgMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMsgMetadataRequest>
            <urn:m ids="$ids" />
        </urn:GetMsgMetadataRequest>
        <urn:GetMsgMetadataResponse>
            <urn:chat id="$id" autoSendTime="$autoSendTime">
                <urn:e a="$address" d="$display" p="$personal" t="t" />
                <urn:su>$subject</urn:su>
                <urn:fr>$fragment</urn:fr>
                <urn:inv type="task" />
            </urn:chat>
            <urn:m id="$id" autoSendTime="$autoSendTime">
                <urn:e a="$address" d="$display" p="$personal" t="t" />
                <urn:su>$subject</urn:su>
                <urn:fr>$fragment</urn:fr>
                <urn:inv type="task" />
            </urn:m>
        </urn:GetMsgMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMsgMetadataEnvelope::class, 'xml'));
    }
}
