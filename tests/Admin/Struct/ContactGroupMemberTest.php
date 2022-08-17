<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ContactGroupMember;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactGroupMember.
 */
class ContactGroupMemberTest extends ZimbraTestCase
{
    public function testContactGroupMember()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $contact = new ContactInfo;

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
<result type="$type" value="$value" xmlns:urn="urn:zimbraAdmin">
    <urn:cn />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($member, 'xml'));
        $this->assertEquals($member, $this->serializer->deserialize($xml, StubContactGroupMember::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubContactGroupMember extends ContactGroupMember
{
}
