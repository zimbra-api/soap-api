<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Common\Enum\ModifyGroupMemberOperation;

use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Mail\Struct\ModifyContactGroupMember;
use Zimbra\Mail\Struct\ModifyContactAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyContactSpec.
 */
class ModifyContactSpecTest extends ZimbraTestCase
{
    public function testModifyContactSpec()
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
        $operation = $this->faker->word;

        $attr = new ModifyContactAttr(
            $name, $operation, $attachId, $id, $part, $value
        );
        $member = new ModifyContactGroupMember(
            ModifyGroupMemberOperation::ADD(), MemberType::CONTACT(), $value
        );

        $contact = new StubModifyContactSpec(
            $id, $tagNames, [$attr], [$member]
        );
        $this->assertSame($id, $contact->getId());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame([$attr], $contact->getAttrs());
        $this->assertSame([$member], $contact->getContactGroupMembers());

        $contact = new StubModifyContactSpec();
        $contact->setId($id)
            ->setTagNames($tagNames)
            ->setAttrs([$attr])
            ->addAttr($attr)
            ->setContactGroupMembers([$member])
            ->addContactGroupMember($member);
        $this->assertSame($id, $contact->getId());
        $this->assertSame($tagNames, $contact->getTagNames());
        $this->assertSame([$attr, $attr], $contact->getAttrs());
        $this->assertSame([$member, $member], $contact->getContactGroupMembers());

        $contact = new StubModifyContactSpec(
            $id, $tagNames, [$attr], [$member]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" tn="$tagNames" xmlns:urn="urn:zimbraMail">
    <urn:a n="$name" op="$operation" aid="$attachId" id="$id" part="$part">$value</urn:a>
    <urn:m op="+" type="C" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contact, 'xml'));
        $this->assertEquals($contact, $this->serializer->deserialize($xml, StubModifyContactSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubModifyContactSpec extends ModifyContactSpec
{
}
