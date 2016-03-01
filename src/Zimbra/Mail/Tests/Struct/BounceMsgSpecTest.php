<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AddressType;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\BounceMsgSpec;

/**
 * Testcase class for BounceMsgSpec.
 */
class BounceMsgSpecTest extends ZimbraMailTestCase
{
    public function testBounceMsgSpec()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->word;
        $personal = $this->faker->word;

        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);
        $m = new BounceMsgSpec($id, [$e]);

        $this->assertSame($id, $m->getId());
        $this->assertSame([$e], $m->getEmailAddresses()->all());

        $m->setId($id)
          ->addEmailAddresses($e);
        $this->assertSame($id, $m->getId());
        $this->assertSame([$e, $e], $m->getEmailAddresses()->all());
        $m->getEmailAddresses()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m id="' . $id . '">'
                .'<e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => $id,
                'e' => array(
                    array(
                        'a' => $address,
                        't' => AddressType::FROM()->value(),
                        'p' => $personal,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
