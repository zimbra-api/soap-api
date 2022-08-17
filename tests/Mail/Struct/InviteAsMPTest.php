<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MPInviteInfo;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Common\Struct\KeyValuePair;
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
        $addressType = AddressType::TO();
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

        $msg = new StubInviteAsMP($id, $part, $sentDate, [$email], $subject, $messageIdHeader, $invite, [$header], $contentElems);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($part, $msg->getPart());
        $this->assertSame($sentDate, $msg->getSentDate());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header], $msg->getHeaders());
        $this->assertEquals($contentElems, $msg->getContentElems());

        $msg = new StubInviteAsMP();
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
<result id="$id" part="$part" sd="$sentDate" xmlns:urn="urn:zimbraMail">
    <urn:e a="$address" d="$display" p="$personal" t="t" />
    <urn:su>$subject</urn:su>
    <urn:mid>$messageIdHeader</urn:mid>
    <urn:inv type="task" />
    <urn:header n="$key">$value</urn:header>
    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
        <urn:content>$content</urn:content>
    </urn:mp>
    <urn:shr truncated="true">
        <urn:content>$content</urn:content>
    </urn:shr>
    <urn:dlSubs truncated="true">
        <urn:content>$content</urn:content>
    </urn:dlSubs>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubInviteAsMP::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubInviteAsMP extends InviteAsMP
{
}
