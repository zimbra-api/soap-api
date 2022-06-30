<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\CalItemRequestBase;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Soap\EnvelopeInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalItemRequestBase.
 */
class CalItemRequestBaseTest extends ZimbraTestCase
{
    public function testCalItemRequestBase()
    {
        $id = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

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
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $maxSize = $this->faker->randomNumber;

        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject,
            [new Header($name, $value)], $inReplyTo, $folderId, $flags, $content,
            new MimePartInfo($contentType, $content, $contentId),
            new AttachmentsInfo($id),
            new InvitationInfo($method, $componentNum, TRUE),
            [new EmailAddrInfo($address, AddressType::TO(), $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)],
            $fragment
        );

        $request = new CalItemRequest($msg, FALSE, $maxSize, FALSE, FALSE, FALSE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertFalse($request->getEcho());
        $this->assertSame($maxSize, $request->getMaxSize());
        $this->assertFalse($request->getWantHtml());
        $this->assertFalse($request->getNeuter());
        $this->assertFalse($request->getForceSend());

        $request = new CalItemRequest();
        $request->setMsg($msg)
            ->setEcho(TRUE)
            ->setMaxSize($maxSize)
            ->setWantHtml(TRUE)
            ->setNeuter(TRUE)
            ->setForceSend(TRUE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertTrue($request->getEcho());
        $this->assertSame($maxSize, $request->getMaxSize());
        $this->assertTrue($request->getWantHtml());
        $this->assertTrue($request->getNeuter());
        $this->assertTrue($request->getForceSend());

        $xml = <<<EOT
<?xml version="1.0"?>
<result echo="true" max="$maxSize" want="true" neuter="true" forcesend="true" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($request, 'xml'));
        $this->assertEquals($request, $this->serializer->deserialize($xml, CalItemRequest::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class CalItemRequest extends CalItemRequestBase
{
    protected function envelopeInit(): EnvelopeInterface
    {
    }
}
