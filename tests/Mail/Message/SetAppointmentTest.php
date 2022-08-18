<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\SetAppointmentEnvelope;
use Zimbra\Mail\Message\SetAppointmentBody;
use Zimbra\Mail\Message\SetAppointmentRequest;
use Zimbra\Mail\Message\SetAppointmentResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\ExceptIdInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\SetCalendarItemInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetAppointment.
 */
class SetAppointmentTest extends ZimbraTestCase
{
    public function testSetAppointment()
    {
        $id = $this->faker->word;
        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED;
        $identityId = $this->faker->uuid;
        $subject = $this->faker->text;
        $inReplyTo = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
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
        $nextAlarm = $this->faker->randomNumber;
        $partStat = ParticipationStatus::ACCEPT;
        $sequence = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $recurrenceId = $this->faker->uuid;

        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject,
            [new Header($name, $value)], $inReplyTo, $folderId, $flags, $content,
            new MimePartInfo($contentType, $content, $contentId), new AttachmentsInfo($id),
            new InvitationInfo($method, $componentNum, TRUE),
            [new EmailAddrInfo($address, AddressType::TO, $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)], $fragment
        );
        $item = new SetCalendarItemInfo($partStat, $msg);
        $reply = new CalReply(
            $rangeType, $recurId, $sequence, $date, $attendee, $sentBy, $partStat
        );

        $request = new SetAppointmentRequest(
            $flags, $tags, $tagNames, $folderId, FALSE, $nextAlarm, $item, [$item], [$item], [$reply]
        );
        $this->assertSame($flags, $request->getFlags());
        $this->assertSame($tags, $request->getTags());
        $this->assertSame($tagNames, $request->getTagNames());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertFalse($request->getNoNextAlarm());
        $this->assertSame($nextAlarm, $request->getNextAlarm());
        $this->assertSame($item, $request->getDefaultId());
        $this->assertSame([$item], $request->getExceptions());
        $this->assertSame([$item], $request->getCancellations());
        $this->assertSame([$reply], $request->getReplies());
        $request->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setFolderId($folderId)
            ->setNoNextAlarm(TRUE)
            ->setNextAlarm($nextAlarm)
            ->setDefaultId($item)
            ->setExceptions([$item])
            ->addException($item)
            ->setCancellations([$item])
            ->addCancellation($item)
            ->setReplies([$reply])
            ->addReply($reply);
        $this->assertSame($flags, $request->getFlags());
        $this->assertSame($tags, $request->getTags());
        $this->assertSame($tagNames, $request->getTagNames());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertTrue($request->getNoNextAlarm());
        $this->assertSame($nextAlarm, $request->getNextAlarm());
        $this->assertSame($item, $request->getDefaultId());
        $this->assertSame([$item, $item], $request->getExceptions());
        $this->assertSame([$item, $item], $request->getCancellations());
        $this->assertSame([$reply, $reply], $request->getReplies());
        $request->setExceptions([$item])
            ->setCancellations([$item])
            ->setReplies([$reply]);

        $default = new Id($id);
        $except = new ExceptIdInfo($recurrenceId, $id);
        $response = new SetAppointmentResponse(
            $calItemId, $deprecatedApptId, $default, [$except]
        );
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($default, $response->getDefaultId());
        $this->assertSame([$except], $response->getExceptions());
        $response = new SetAppointmentResponse();
        $response->setCalItemId($calItemId)
            ->setDeprecatedApptId($deprecatedApptId)
            ->setDefaultId($default)
            ->setExceptions([$except]);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($default, $response->getDefaultId());
        $this->assertSame([$except], $response->getExceptions());

        $body = new SetAppointmentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetAppointmentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetAppointmentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetAppointmentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetAppointmentRequest f="$flags" t="$tags" tn="$tagNames" l="$folderId" noNextAlarm="true" nextAlarm="$nextAlarm">
            <urn:default ptst="AC">
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
            </urn:default>
            <urn:except ptst="AC">
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
            </urn:except>
            <urn:cancel ptst="AC">
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
            </urn:cancel>
            <urn:replies>
                <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$sequence" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
            </urn:replies>
        </urn:SetAppointmentRequest>
        <urn:SetAppointmentResponse calItemId="$calItemId" apptId="$deprecatedApptId">
            <urn:default id="$id" />
            <urn:except recurId="$recurrenceId" id="$id" />
        </urn:SetAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetAppointmentEnvelope::class, 'xml'));
    }
}
