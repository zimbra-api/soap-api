<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ZimletStatus;
use Zimbra\Admin\Struct\ZimletStatusParent;
use Zimbra\Common\Enum\ZimletStatusSetting;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZimletStatusParent.
 */
class ZimletStatusParentTest extends ZimbraTestCase
{
    public function testZimletStatusParent()
    {
        $name = $this->faker->name;
        $priority = mt_rand(1, 100);

        $zimlet = new ZimletStatus($name, ZimletStatusSetting::ENABLED(), TRUE, $priority);

        $zimlets = new ZimletStatusParent([$zimlet]);
        $this->assertSame([$zimlet], $zimlets->getZimlets());

        $zimlets = new ZimletStatusParent();
        $zimlets->setZimlets([$zimlet])
             ->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $zimlets->getZimlets());
        $zimlets->setZimlets([$zimlet]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <zimlet name="$name" status="enabled" extension="true" priority="$priority" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlets, 'xml'));
        $this->assertEquals($zimlets, $this->serializer->deserialize($xml, ZimletStatusParent::class, 'xml'));

        $json = json_encode([
            'zimlet' => [
                [
                    'name' => $name,
                    'status' => 'enabled',
                    'extension' => TRUE,
                    'priority' => $priority,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlets, 'json'));
        $this->assertEquals($zimlets, $this->serializer->deserialize($json, ZimletStatusParent::class, 'json'));
    }
}
