<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ContactGroupMember;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactGroupMember.
 */
class ContactGroupMemberTest extends ZimbraStructTestCase
{
    public function testContactGroupMember()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $contact = new ContactInfo;

        $member = new ContactGroupMember($type, $value, $contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $member = new ContactGroupMember('', '');
        $member->setType($type)
            ->setValue($value)
            ->setContact($contact);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());
        $this->assertSame($contact, $member->getContact());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<m type="' . $type . '" value="' . $value . '">'
            . '<cn />'
            . '</m>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($member, 'xml'));
        $this->assertEquals($member, $this->serializer->deserialize($xml, ContactGroupMember::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'value' => $value,
            'cn' => new \stdClass,
        ]);
        $this->assertSame($json, $this->serializer->serialize($member, 'json'));
        $this->assertEquals($member, $this->serializer->deserialize($json, ContactGroupMember::class, 'json'));
    }
}
