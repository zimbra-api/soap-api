<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MPInviteInfo;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\CalEcho;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalEcho.
 */
class CalEchoTest extends ZimbraTestCase
{
    public function testCalEcho()
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

        $echo = new CalEcho($invite);
        $this->assertSame($invite, $echo->getInvite());
        $echo = new CalEcho();
        $echo->setInvite($invite);
        $this->assertSame($invite, $echo->getInvite());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <m id="$id" part="$part" sd="$sentDate">
        <e a="$address" d="$display" p="$personal" t="t" />
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($echo, 'xml'));
        $this->assertEquals($echo, $this->serializer->deserialize($xml, CalEcho::class, 'xml'));
    }
}
