<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\ZimletStatus;
use Zimbra\Account\Struct\ZimletPrefsSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZimletPrefsSpec.
 */
class ZimletPrefsSpecTest extends ZimbraStructTestCase
{
    public function testZimletPrefsSpec()
    {
        $name = $this->faker->word;

        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED()->value());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame(ZimletStatus::ENABLED()->value(), $zimlet->getPresence());

        $zimlet = new ZimletPrefsSpec('', '');
        $zimlet->setName($name)
               ->setPresence(ZimletStatus::DISABLED()->value());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame(ZimletStatus::DISABLED()->value(), $zimlet->getPresence());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '" presence="' . ZimletStatus::DISABLED() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));

        $zimlet = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\ZimletPrefsSpec', 'xml');
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame(ZimletStatus::DISABLED()->value(), $zimlet->getPresence());
    }
}
