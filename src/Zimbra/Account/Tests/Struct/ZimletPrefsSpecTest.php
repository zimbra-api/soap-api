<?php declare(strict_types=1);

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

        $zimlet = new ZimletPrefsSpec($name, ZimletStatus::ENABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::ENABLED(), $zimlet->getPresence());

        $zimlet = new ZimletPrefsSpec('', ZimletStatus::ENABLED());
        $zimlet->setName($name)
               ->setPresence(ZimletStatus::DISABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatus::DISABLED(), $zimlet->getPresence());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '" presence="' . ZimletStatus::DISABLED() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ZimletPrefsSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'presence' => (string) ZimletStatus::DISABLED(),
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, ZimletPrefsSpec::class, 'json'));
    }
}
