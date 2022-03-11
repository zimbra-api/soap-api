<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EmailInfo.
 */
class EmailInfoTest extends ZimbraTestCase
{
    public function testEmailInfo()
    {
        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO();

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $this->assertSame($address, $email->getAddress());
        $this->assertSame($display, $email->getDisplay());
        $this->assertSame($personal, $email->getPersonal());
        $this->assertSame($addressType, $email->getAddressType());

        $email = new EmailInfo();
        $email->setAddress($address)
              ->setDisplay($display)
              ->setAddressType($addressType)
              ->setPersonal($personal)
              ->setGroup(TRUE)
              ->setCanExpandGroupMembers(TRUE);
        $this->assertSame($address, $email->getAddress());
        $this->assertSame($display, $email->getDisplay());
        $this->assertSame($addressType, $email->getAddressType());
        $this->assertSame($personal, $email->getPersonal());
        $this->assertTrue($email->getGroup());
        $this->assertTrue($email->getCanExpandGroupMembers());

        $xml = <<<EOT
<?xml version="1.0"?>
<result a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($email, 'xml'));
        $this->assertEquals($email, $this->serializer->deserialize($xml, EmailInfo::class, 'xml'));

        $json = json_encode([
            'a' => $address,
            'd' => $display,
            'p' => $personal,
            't' => 't',
            'isGroup' => TRUE,
            'exp' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($email, 'json'));
        $this->assertEquals($email, $this->serializer->deserialize($json, EmailInfo::class, 'json'));
    }
}
