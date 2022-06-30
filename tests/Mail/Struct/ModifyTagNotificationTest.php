<?php

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\ModifyTagNotification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyTagNotification.
 */
class ModifyTagNotificationTest extends ZimbraTestCase
{
    public function testModifyTagNotification()
    {
        $changeBitmask = mt_rand(1, 99);
        $id = mt_rand(1, 99);
        $name = $this->faker->word;
        $item = new StubModifyTagNotification($id, $name, $changeBitmask);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());

        $item = new StubModifyTagNotification(0, '', $changeBitmask);
        $item->setId($id)
             ->setName($name);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result change="$changeBitmask" xmlns:urn="urn:zimbraMail">
    <urn:id>$id</urn:id>
    <urn:name>$name</urn:name>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, StubModifyTagNotification::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubModifyTagNotification extends ModifyTagNotification
{
}
