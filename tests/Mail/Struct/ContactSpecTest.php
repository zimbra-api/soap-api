<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\MemberType;
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

        $contact = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );
        $this->assertSame($id, $contact->getId());
        $this->assertSame($folder, $contact->getFolder());
        $this->assertSame($tags, $contact->getTags());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame($vcard, $contact->getVcard());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());

        $contact = new ContactSpec();
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

        $contact = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<cn id="$id" l="$folder" t="$tags" tn="$tagNames">
    <vcard mid="$messageId" part="$part" aid="$attachId">$value</vcard>
    <a n="$name" aid="$attachId" id="$id" part="$part">$value</a>
    <m type="C" value="$value" />
</cn>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contact, 'xml'));
        $this->assertEquals($contact, $this->serializer->deserialize($xml, ContactSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'l' => $folder,
            't' => $tags,
            'tn' => $tagNames,
            'vcard' => [
                'mid' => $messageId,
                'part' => $part,
                'aid' => $attachId,
                '_content' => $value,
            ],
            'a' => [
                [
                    'n' => $name,
                    'aid' => $attachId,
                    'id' => $id,
                    'part' => $part,
                    '_content' => $value,
                ],
            ],
            'm' => [
                [
                    'type' => 'C',
                    'value' => $value,
                ]
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($contact, 'json'));
        $this->assertEquals($contact, $this->serializer->deserialize($json, ContactSpec::class, 'json'));
    }
}
