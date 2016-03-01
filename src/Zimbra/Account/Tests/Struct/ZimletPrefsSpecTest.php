<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Account\Struct\ZimletPrefsSpec;

/**
 * Testcase class for ZimletPrefsSpec.
 */
class ZimletPrefsSpecTest extends ZimbraAccountTestCase
{
    public function testZimletPrefsSpec()
    {
        $name = $this->faker->word;

        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame('enabled', $zimlet->getPresence()->value());

        $zimlet->setName($name)
               ->setPresence(ZimletStatus::DISABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame('disabled', $zimlet->getPresence()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '" presence="' . ZimletStatus::DISABLED() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = [
            'zimlet' => [
                'name' => $name,
                'presence' => ZimletStatus::DISABLED()->value(),
            ],
        ];
        $this->assertEquals($array, $zimlet->toArray());
    }
}
