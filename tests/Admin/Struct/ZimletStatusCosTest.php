<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ZimletStatus;
use Zimbra\Admin\Struct\ZimletStatusCos;
use Zimbra\Common\Enum\ZimletStatusSetting;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZimletStatusCos.
 */
class ZimletStatusCosTest extends ZimbraTestCase
{
    public function testZimletStatusCos()
    {
        $name = $this->faker->name;
        $priority = mt_rand(1, 100);

        $zimlet = new ZimletStatus($name, ZimletStatusSetting::ENABLED(), TRUE, $priority);

        $cos = new ZimletStatusCos($name, [$zimlet]);
        $this->assertSame($name, $cos->getName());
        $this->assertSame([$zimlet], $cos->getZimlets());

        $cos = new ZimletStatusCos('');
        $cos->setName($name)
            ->setZimlets([$zimlet])
            ->addZimlet($zimlet);
        $this->assertSame($name, $cos->getName());
        $this->assertSame([$zimlet, $zimlet], $cos->getZimlets());
        $cos->setZimlets([$zimlet]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">
    <zimlet name="$name" status="enabled" extension="true" priority="$priority" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, ZimletStatusCos::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'zimlet' => [
                [
                    'name' => $name,
                    'status' => 'enabled',
                    'extension' => TRUE,
                    'priority' => $priority,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cos, 'json'));
        $this->assertEquals($cos, $this->serializer->deserialize($json, ZimletStatusCos::class, 'json'));
    }
}
