<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Mail\Struct\ContactGroupMember;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactGroupMember.
 */
class ContactGroupMemberTest extends ZimbraTestCase
{
    public function testContactGroupMember()
    {
        $id = $this->faker->uuid;
        $type = MemberType::CONTACT();
        $value = $this->faker->word;

        $contact = new ContactInfo($id);

        $member = new StubContactGroupMember($type, $value, $contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $member = new StubContactGroupMember();
        $member->setType($type)
            ->setValue($value)
            ->setContact($contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="C" value="$value" xmlns:urn="urn:zimbraMail">
    <urn:cn id="$id" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($member, 'xml'));
        $this->assertEquals($member, $this->serializer->deserialize($xml, StubContactGroupMember::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubContactGroupMember extends ContactGroupMember
{
}
