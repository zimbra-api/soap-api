<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AddressType;
use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BounceMsgSpec.
 */
class BounceMsgSpecTest extends ZimbraTestCase
{
    public function testBounceMsgSpec()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->email;
        $addressType = AddressType::FROM();
        $personal = $this->faker->word;

        $emailAddress = new EmailAddrInfo($address, $addressType, $personal);

        $msg = new BounceMsgSpec($id, [$emailAddress]);
        $this->assertSame($id, $msg->getId());
        $this->assertSame([$emailAddress], $msg->getEmailAddresses());

        $msg = new BounceMsgSpec('');
        $msg->setId($id)
            ->setEmailAddresses([$emailAddress])
            ->addEmailAddress($emailAddress);
        $this->assertSame($id, $msg->getId());
        $this->assertSame([$emailAddress, $emailAddress], $msg->getEmailAddresses());
        $msg->setEmailAddresses([$emailAddress]);

        $xml = <<<EOT
<?xml version="1.0"?>
<msg id="$id">
    <e a="$address" t="f" p="$personal" />
</msg>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, BounceMsgSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'e' => [
                [
                    'a' => $address,
                    't' => 'f',
                    'p' => $personal,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($msg, 'json'));
        $this->assertEquals($msg, $this->serializer->deserialize($json, BounceMsgSpec::class, 'json'));
    }
}