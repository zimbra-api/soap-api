<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AddressType;
use Zimbra\Mail\Struct\EmailAddrInfo;

/**
 * Testcase class for EmailAddrInfo.
 */
class EmailAddrInfoTest extends ZimbraMailTestCase
{
    public function testEmailAddrInfo()
    {
        $address = $this->faker->word;
        $personal = $this->faker->word;

        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);
        $this->assertSame($address, $e->getAddress());
        $this->assertSame('f', $e->getAddressType()->value());
        $this->assertSame($personal, $e->getPersonal());

        $e->setAddress($address)
          ->setAddressType(AddressType::TO())
          ->setPersonal($personal);
        $this->assertSame($address, $e->getAddress());
        $this->assertSame('t', $e->getAddressType()->value());
        $this->assertSame($personal, $e->getPersonal());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<e a="' . $address . '" t="' . AddressType::TO() . '" p="' . $personal . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $e);

        $array = array(
            'e' => array(
                'a' => $address,
                't' => AddressType::TO()->value(),
                'p' => $personal,
            ),
        );
        $this->assertEquals($array, $e->toArray());
    }
}
