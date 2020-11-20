<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ModifyNotification;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyNotification.
 */
class ModifyNotificationTest extends ZimbraStructTestCase
{
    public function testModifyNotification()
    {
        $changeBitmask = mt_rand(1, 99);

        $mod = new ModifyNotification($changeBitmask);
        $this->assertSame($changeBitmask, $mod->getChangeBitmask());

        $mod = new ModifyNotification(0);
        $mod->setChangeBitmask($changeBitmask);
        $this->assertSame($changeBitmask, $mod->getChangeBitmask());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mod change="' . $changeBitmask . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mod, 'xml'));
        $this->assertEquals($mod, $this->serializer->deserialize($xml, ModifyNotification::class, 'xml'));

        $json = json_encode([
            'change' => $changeBitmask,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mod, 'json'));
        $this->assertEquals($mod, $this->serializer->deserialize($json, ModifyNotification::class, 'json'));
    }
}
