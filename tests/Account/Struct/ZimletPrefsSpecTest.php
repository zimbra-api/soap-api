<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\ZimletStatus;
use Zimbra\Account\Struct\ZimletPrefsSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZimletPrefsSpec.
 */
class ZimletPrefsSpecTest extends ZimbraTestCase
{
    public function testZimletPrefsSpec()
    {
        $name = $this->faker->name;

        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED);
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::ENABLED, $zimlet->getPresence());

        $zimlet = new ZimletPrefsSpec();
        $zimlet->setName($name)
               ->setPresence(ZimletStatus::DISABLED);
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::DISABLED, $zimlet->getPresence());

        $presence = ZimletStatus::DISABLED->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" presence="$presence" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ZimletPrefsSpec::class, 'xml'));
    }
}
