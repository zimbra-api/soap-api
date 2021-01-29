<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EmailAddrInfo.
 */
class EmailAddrInfoTest extends ZimbraTestCase
{
    public function testEmailAddrInfo()
    {
        $address = $this->faker->email;
        $addressType = AddressType::FROM();
        $personal = $this->faker->word;

        $email = new EmailAddrInfo($address, $addressType, $personal);
        $this->assertSame($address, $email->getAddress());
        $this->assertSame($addressType, $email->getAddressType());
        $this->assertSame($personal, $email->getPersonal());

        $email = new EmailAddrInfo('');
        $email->setAddress($address)
              ->setAddressType($addressType)
              ->setPersonal($personal);
        $this->assertSame($address, $email->getAddress());
        $this->assertSame($addressType, $email->getAddressType());
        $this->assertSame($personal, $email->getPersonal());

        $xml = <<<EOT
<?xml version="1.0"?>
<email a="$address" t="f" p="$personal" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($email, 'xml'));
        $this->assertEquals($email, $this->serializer->deserialize($xml, EmailAddrInfo::class, 'xml'));

        $json = json_encode([
            'a' => $address,
            't' => 'f',
            'p' => $personal,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($email, 'json'));
        $this->assertEquals($email, $this->serializer->deserialize($json, EmailAddrInfo::class, 'json'));
    }
}
