<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\MemberType;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewContactGroupMember.
 */
class NewContactGroupMemberTest extends ZimbraTestCase
{
    public function testNewContactGroupMember()
    {
        $type = MemberType::CONTACT;
        $value = $this->faker->word;

        $member = new NewContactGroupMember($type, $value);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());

        $member = new NewContactGroupMember(MemberType::CONTACT, '');
        $member->setType($type)
            ->setValue($value);
        $this->assertSame($type, $member->getType());
        $this->assertSame($value, $member->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="C" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($member, 'xml'));
        $this->assertEquals($member, $this->serializer->deserialize($xml, NewContactGroupMember::class, 'xml'));
    }
}
