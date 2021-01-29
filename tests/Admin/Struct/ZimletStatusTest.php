<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ZimletStatus;
use Zimbra\Enum\ZimletStatusSetting;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ZimletStatus.
 */
class ZimletStatusTest extends ZimbraStructTestCase
{
    public function testZimletStatus()
    {
        $name = $this->faker->name;
        $priority = mt_rand(1, 100);

        $zimlet = new ZimletStatus($name, ZimletStatusSetting::DISABLED(), FALSE, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatusSetting::DISABLED(), $zimlet->getStatus());
        $this->assertFalse($zimlet->getExtension());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet = new ZimletStatus('', ZimletStatusSetting::DISABLED(), FALSE, 0);
        $zimlet->setName($name)
            ->setStatus(ZimletStatusSetting::ENABLED())
            ->setExtension(TRUE)
            ->setPriority($priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertEquals(ZimletStatusSetting::ENABLED(), $zimlet->getStatus());
        $this->assertTrue($zimlet->getExtension());
        $this->assertSame($priority, $zimlet->getPriority());

        $xml = <<<EOT
<?xml version="1.0"?>
<zimlet name="$name" status="enabled" extension="true" priority="$priority" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ZimletStatus::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'status' => 'enabled',
            'extension' => TRUE,
            'priority' => $priority,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, ZimletStatus::class, 'json'));
    }
}
