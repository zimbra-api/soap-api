<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Mail\Message\AddTaskInviteEnvelope;
use Zimbra\Mail\Message\AddTaskInviteBody;
use Zimbra\Mail\Message\AddTaskInviteRequest;
use Zimbra\Mail\Message\AddTaskInviteResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddTaskInvite.
 */
class AddTaskInviteTest extends ZimbraTestCase
{
    public function testAddTaskInvite()
    {
        $partStat = ParticipationStatus::ACCEPT;

        $id = $this->faker->word;
        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED;
        $identityId = $this->faker->uuid;
        $subject = $this->faker->text;
        $inReplyTo = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $content = $this->faker->text;
        $fragment = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $calItemId = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;

        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject,
            [new Header($name, $value)], $inReplyTo, $folderId, $flags, $content,
            new MimePartInfo($contentType, $content, $contentId), new AttachmentsInfo($id),
            new InvitationInfo($method, $componentNum, TRUE),
            [new EmailAddrInfo($address, AddressType::TO, $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)], $fragment
        );

        $request = new AddTaskInviteRequest($partStat, $msg);

        $response = new AddTaskInviteResponse($calItemId, $invId, $componentNum);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());

        $response = new AddTaskInviteResponse();
        $response->setCalItemId($calItemId)
            ->setInvId($invId)
            ->setComponentNum($componentNum);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());

        $body = new AddTaskInviteBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AddTaskInviteBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddTaskInviteEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AddTaskInviteEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddTaskInviteRequest ptst="AC">
            <urn:m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
                <urn:header name="$name">$value</urn:header>
                <urn:content>$content</urn:content>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:attach aid="$id" />
                <urn:inv method="$method" compNum="$componentNum" rsvp="true" />
                <urn:e a="$address" t="t" p="$personal" />
                <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <urn:fr>$fragment</urn:fr>
            </urn:m>
        </urn:AddTaskInviteRequest>
        <urn:AddTaskInviteResponse calItemId="$calItemId" invId="$invId" compNum="$componentNum" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddTaskInviteEnvelope::class, 'xml'));
    }
}
