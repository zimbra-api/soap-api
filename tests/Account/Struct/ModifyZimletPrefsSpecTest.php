<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\ZimletStatus;
use Zimbra\Account\Struct\ModifyZimletPrefsSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyZimletPrefsSpec.
 */
class ModifyZimletPrefsSpecTest extends ZimbraTestCase
{
    public function testModifyZimletPrefsSpec()
    {
        $name = $this->faker->name;

        $zimlet = new ModifyZimletPrefsSpec($name, ZimletStatus::DISABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::DISABLED(), $zimlet->getPresence());

        $zimlet = new ModifyZimletPrefsSpec('', ZimletStatus::DISABLED());
        $zimlet->setName($name)
               ->setPresence(ZimletStatus::ENABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::ENABLED(), $zimlet->getPresence());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" presence="enabled" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ModifyZimletPrefsSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'presence' => 'enabled',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, ModifyZimletPrefsSpec::class, 'json'));
    }
}
