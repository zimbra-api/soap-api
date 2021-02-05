<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\InviteType;

use Zimbra\Mail\Struct\CreateCalendarItemResponse;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MPInviteInfo;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\CalEcho;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;

use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Id;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateCalendarItemResponse.
 */
class CreateCalendarItemResponseTest extends ZimbraTestCase
{
    public function testCreateCalendarItemResponse()
    {
        $id = $this->faker->uuid;
        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $subject = $this->faker->text;
        $messageIdHeader = $this->faker->uuid;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::FROM();
        $calItemType = InviteType::TASK();

        $key = $this->faker->word;
        $value = $this->faker->word;

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $contentElems = [
            new PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new ShareNotification(TRUE, $content),
            new DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new InviteAsMP(
            $id, $part, $sentDate,
            [new EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new MPInviteInfo($calItemType), [new KeyValuePair($key, $value)],
            $contentElems
        );

        $msg = new Id($id);
        $echo = new CalEcho($invite);

        $response = new CreateCalendarItemResponse(
            $calItemId, $deprecatedApptId, $calInvId, $modifiedSequence, $revision, $msg, $echo
        );
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertSame($msg, $response->getMsg());
        $this->assertSame($echo, $response->getEcho());

        $response = new CreateCalendarItemResponse();
        $response->setCalItemId($calItemId)
            ->setDeprecatedApptId($deprecatedApptId)
            ->setCalInvId($calInvId)
            ->setModifiedSequence($modifiedSequence)
            ->setRevision($revision)
            ->setMsg($msg)
            ->setEcho($echo);
        $this->assertSame($calItemId, $response->getCalItemId());
        $this->assertSame($deprecatedApptId, $response->getDeprecatedApptId());
        $this->assertSame($calInvId, $response->getCalInvId());
        $this->assertSame($modifiedSequence, $response->getModifiedSequence());
        $this->assertSame($revision, $response->getRevision());
        $this->assertSame($msg, $response->getMsg());
        $this->assertSame($echo, $response->getEcho());

        $xml = <<<EOT
<?xml version="1.0"?>
<response calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
    <m id="$id" />
    <echo>
        <m id="$id" part="$part" sd="$sentDate">
            <e a="$address" d="$display" p="$personal" t="f" />
            <su>$subject</su>
            <mid>$messageIdHeader</mid>
            <inv type="task" />
            <header n="$key">$value</header>
            <mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                <content>$content</content>
            </mp>
            <shr truncated="true">
                <content>$content</content>
            </shr>
            <dlSubs truncated="true">
                <content>$content</content>
            </dlSubs>
        </m>
    </echo>
</response>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($response, 'xml'));
        $this->assertEquals($response, $this->serializer->deserialize($xml, CreateCalendarItemResponse::class, 'xml'));

        $json = json_encode([
            'calItemId' => $calItemId,
            'apptId' => $deprecatedApptId,
            'invId' => $calInvId,
            'ms' => $modifiedSequence,
            'rev' => $revision,
            'm' => [
                'id' => $id,
            ],
            'echo' => [
                'm' => [
                    'id' => $id,
                    'part' => $part,
                    'sd' => $sentDate,
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
                    'mid' => [
                        '_content' => $messageIdHeader,
                    ],
                    'inv' => [
                        'type' => 'task',
                    ],
                    'header' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'mp' => [
                        [
                            'part' => $part,
                            'ct' => $contentType,
                            's' => $size,
                            'cd' => $contentDisposition,
                            'filename' => $contentFilename,
                            'ci' => $contentId,
                            'cl' => $location,
                            'body' => TRUE,
                            'truncated' => TRUE,
                            'content' => [
                                '_content' => $content,
                            ],
                        ],
                    ],
                    'shr' => [
                        [
                            'truncated' => TRUE,
                            'content' => [
                                '_content' => $content,
                            ],
                        ],
                    ],
                    'dlSubs' => [
                        [
                            'truncated' => TRUE,
                            'content' => [
                                '_content' => $content,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($response, 'json'));
        $this->assertEquals($response, $this->serializer->deserialize($json, CreateCalendarItemResponse::class, 'json'));
    }
}
