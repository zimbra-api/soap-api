<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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
use Zimbra\Mail\Struct\SetCalendarItemInfoTrait;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetCalendarItemInfoTrait.
 */
class SetCalendarItemInfoTraitTest extends ZimbraTestCase
{
    public function testSetCalendarItemInfoTrait()
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
        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject,
            [new Header($name, $value)], $inReplyTo, $folderId, $flags, $content,
            new MimePartInfo($contentType, $content, $contentId), new AttachmentsInfo($id),
            new InvitationInfo($method, $componentNum, TRUE),
            [new EmailAddrInfo($address, AddressType::TO(), $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)], $fragment
        );

        $item = new SetCalendarItemInfoImp($partStat, $msg);
        $this->assertSame($partStat, $item->getPartStat());
        $this->assertSame($msg, $item->getMsg());

        $item = new SetCalendarItemInfoImp();
        $item->setPartStat($partStat)
            ->setMsg($msg);
        $this->assertSame($partStat, $item->getPartStat());
        $this->assertSame($msg, $item->getMsg());

        $xml = <<<EOT
<?xml version="1.0"?>
<result ptst="AC">
    <m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
        <header name="$name">$value</header>
        <content>$content</content>
        <mp ct="$contentType" content="$content" ci="$contentId" />
        <attach aid="$id" />
        <inv method="$method" compNum="$componentNum" rsvp="true" />
        <e a="$address" t="t" p="$personal" />
        <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
        <fr>$fragment</fr>
    </m>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, SetCalendarItemInfoImp::class, 'xml'));
    }
}

class SetCalendarItemInfoImp
{
    use SetCalendarItemInfoTrait {
        SetCalendarItemInfoTrait::__construct as private __traitConstruct;
    }

    public function __construct(
        ?ParticipationStatus $partStat = NULL, ?Msg $msg = NULL
    )
    {
        $this->__traitConstruct($partStat, $msg);
    }
}
