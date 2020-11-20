<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ModifyTagNotification;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyTagNotification.
 */
class ModifyTagNotificationTest extends ZimbraStructTestCase
{
    public function testModifyTagNotification()
    {
        $changeBitmask = mt_rand(1, 99);
        $id = mt_rand(1, 99);
        $name = $this->faker->word;
        $item = new ModifyTagNotification($id, $name, $changeBitmask);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());

        $item = new ModifyTagNotification(0, '', $changeBitmask);
        $item->setId($id)
             ->setName($name);
        $this->assertSame($id, $item->getId());
        $this->assertSame($name, $item->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<modTags change="' . $changeBitmask . '">'
                . '<id>' . $id . '</id>'
                . '<name>' . $name . '</name>'
            . '</modTags>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, ModifyTagNotification::class, 'xml'));

        $json = json_encode([
            'change' => $changeBitmask,
            'id' => [
                '_content' => $id,
            ],
            'name' => [
                '_content' => $name,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, ModifyTagNotification::class, 'json'));
    }
}
