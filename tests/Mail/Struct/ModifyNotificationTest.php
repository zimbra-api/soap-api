<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ModifyNotification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyNotification.
 */
class ModifyNotificationTest extends ZimbraTestCase
{
    public function testModifyNotification()
    {
        $changeBitmask = mt_rand(1, 99);

        $mod = new ModifyNotification($changeBitmask);
        $this->assertSame($changeBitmask, $mod->getChangeBitmask());

        $mod = new ModifyNotification(0);
        $mod->setChangeBitmask($changeBitmask);
        $this->assertSame($changeBitmask, $mod->getChangeBitmask());

        $xml = <<<EOT
<?xml version="1.0"?>
<result change="$changeBitmask" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mod, 'xml'));
        $this->assertEquals($mod, $this->serializer->deserialize($xml, ModifyNotification::class, 'xml'));
    }
}
