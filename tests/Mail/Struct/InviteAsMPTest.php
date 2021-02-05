<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\InviteType;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MPInviteInfo;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteAsMP.
 */
class InviteAsMPTest extends ZimbraTestCase
{
    public function testInviteAsMP()
    {
        $id = $this->faker->uuid;
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

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $invite = new MPInviteInfo($calItemType);
        $header = new KeyValuePair($key, $value);

        $mp = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
        );
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $contentElems = [
            $mp,
            $shr,
            $dlSubs,
        ];

        $msg = new InviteAsMP($id, $part, $sentDate, [$email], $subject, $messageIdHeader, $invite, [$header], $contentElems);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($part, $msg->getPart());
        $this->assertSame($sentDate, $msg->getSentDate());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header], $msg->getHeaders());
        $this->assertEquals($contentElems, $msg->getContentElems());

        $msg = new InviteAsMP();
        $msg->setId($id)
            ->setPart($part)
            ->setSentDate($sentDate)
            ->setEmails([$email])
            ->addEmail($email)
            ->setSubject($subject)
            ->setMessageIdHeader($messageIdHeader)
            ->setInvite($invite)
            ->setHeaders([$header])
            ->addHeader($header)
            ->setContentElems($contentElems);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($part, $msg->getPart());
        $this->assertSame($sentDate, $msg->getSentDate());
        $this->assertSame([$email, $email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header, $header], $msg->getHeaders());
        $this->assertEquals($contentElems, $msg->getContentElems());
        $msg->setEmails([$email])->setHeaders([$header]);

        $xml = <<<EOT
<?xml version="1.0"?>
<msg id="$id" part="$part" sd="$sentDate">
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
</msg>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, InviteAsMP::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($msg, 'json'));
        $this->assertEquals($msg, $this->serializer->deserialize($json, InviteAsMP::class, 'json'));
    }
}
