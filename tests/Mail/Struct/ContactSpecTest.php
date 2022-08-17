<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Mail\Struct\VCardInfo;
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactSpec.
 */
class ContactSpecTest extends ZimbraTestCase
{
    public function testContactSpec()
    {
        $id = $this->faker->randomNumber;
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $value = $this->faker->text;
        $part = $this->faker->word;
        $name = $this->faker->word;
        $messageId = $this->faker->uuid;
        $attachId = $this->faker->uuid;

        $vcard = new VCardInfo($messageId, $part, $attachId, $value);
        $attr = new NewContactAttr(
            $name, $attachId, $id, $part, $value
        );
        $member = new NewContactGroupMember(MemberType::CONTACT(), $value);

        $contact = new StubContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );
        $this->assertSame($id, $contact->getId());
        $this->assertSame($folder, $contact->getFolder());
        $this->assertSame($tags, $contact->getTags());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame($vcard, $contact->getVcard());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());

        $contact = new StubContactSpec();
        $contact->setId($id)
            ->setFolder($folder)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setVcard($vcard)
            ->setAttrs([$attr])
            ->setContactGroupMembers([$member]);
        $this->assertSame($id, $contact->getId());
        $this->assertSame($folder, $contact->getFolder());
        $this->assertSame($tags, $contact->getTags());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame($vcard, $contact->getVcard());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());

        $contact->addAttr($attr)
            ->addContactGroupMember($member);
        $this->assertSame([$attr, $attr], $contact->getAttrs());
        $this->assertSame([$member, $member], $contact->getContactGroupMembers());

        $contact = new StubContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" l="$folder" t="$tags" tn="$tagNames" xmlns:urn="urn:zimbraMail">
    <urn:vcard mid="$messageId" part="$part" aid="$attachId">$value</urn:vcard>
    <urn:a n="$name" aid="$attachId" id="$id" part="$part">$value</urn:a>
    <urn:m type="C" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contact, 'xml'));
        $this->assertEquals($contact, $this->serializer->deserialize($xml, StubContactSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubContactSpec extends ContactSpec
{
}
