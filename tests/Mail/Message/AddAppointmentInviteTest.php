<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\ReplyType;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Mail\Message\AddAppointmentInviteEnvelope;
use Zimbra\Mail\Message\AddAppointmentInviteBody;
use Zimbra\Mail\Message\AddAppointmentInviteRequest;
use Zimbra\Mail\Message\AddAppointmentInviteResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddAppointmentInvite.
 */
class AddAppointmentInviteTest extends ZimbraTestCase
{
    public function testAddAppointmentInvite()
    {
        $partStat = ParticipationStatus::ACCEPT();

        $id = $this->faker->word;
        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED();
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
            [new EmailAddrInfo($address, AddressType::FROM(), $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)], $fragment
        );

        $request = new AddAppointmentInviteRequest($partStat, $msg);

        $response = new AddAppointmentInviteResponse($calItemId, $invId, $componentNum);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());

        $response = new AddAppointmentInviteResponse();
        $response->setCalItemId($calItemId)
            ->setInvId($invId)
            ->setComponentNum($componentNum);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($invId, $response->getInvId());
        $this->assertSame($componentNum, $response->getComponentNum());

        $body = new AddAppointmentInviteBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AddAppointmentInviteBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddAppointmentInviteEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AddAppointmentInviteEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddAppointmentInviteRequest ptst="AC">
            <m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
                <header name="$name">$value</header>
                <content>$content</content>
                <mp ct="$contentType" content="$content" ci="$contentId" />
                <attach aid="$id" />
                <inv method="$method" compNum="$componentNum" rsvp="true" />
                <e a="$address" t="f" p="$personal" />
                <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <fr>$fragment</fr>
            </m>
        </urn:AddAppointmentInviteRequest>
        <urn:AddAppointmentInviteResponse calItemId="$calItemId" invId="$invId" compNum="$componentNum" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAppointmentInviteEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddAppointmentInviteRequest' => [
                    'ptst' => 'AC',
                    'm' => [
                        'aid' => $id,
                        'origid' => $origId,
                        'rt' => 'r',
                        'idnt' => $identityId,
                        'su' => $subject,
                        'irt' => $inReplyTo,
                        'l' => $folderId,
                        'f' => $flags,
                        'header' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                            ],
                        ],
                        'content' => [
                            '_content' => $content,
                        ],
                        'mp' => [
                            'ct' => $contentType,
                            'content' => $content,
                            'ci' => $contentId,
                        ],
                        'attach' => [
                            'aid' => $id,
                        ],
                        'inv' => [
                            'method' => $method,
                            'compNum' => $componentNum,
                            'rsvp' => TRUE,
                        ],
                        'e' => [
                            [
                                'a' => $address,
                                't' => 'f',
                                'p' => $personal,
                            ],
                        ],
                        'tz' => [
                            [
                                'id' => $id,
                                'stdoff' => $tzStdOffset,
                                'dayoff' => $tzDayOffset,
                            ],
                        ],
                        'fr' => [
                            '_content' => $fragment,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'AddAppointmentInviteResponse' => [
                    'calItemId' => $calItemId,
                    'invId' => $invId,
                    'compNum' => $componentNum,
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddAppointmentInviteEnvelope::class, 'json'));
    }
}
