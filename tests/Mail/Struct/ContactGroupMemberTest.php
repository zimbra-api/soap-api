<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $member = new ContactGroupMember($type, $value, $contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $member = new ContactGroupMember(MemberType::CONTACT(), '');
        $member->setType($type)
            ->setValue($value)
            ->setContact($contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="C" value="$value">
    <cn id="$id" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($member, 'xml'));
        $this->assertEquals($member, $this->serializer->deserialize($xml, ContactGroupMember::class, 'xml'));

        $json = json_encode([
            'type' => 'C',
            'value' => $value,
            'cn' => [
                'id' => $id,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($member, 'json'));
        $this->assertEquals($member, $this->serializer->deserialize($json, ContactGroupMember::class, 'json'));
    }
}
