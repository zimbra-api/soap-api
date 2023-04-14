<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $zimlet = new ZimletStatus($name, ZimletStatusSetting::ENABLED, TRUE, $priority);

        $cos = new StubZimletStatusCos($name, [$zimlet]);
        $this->assertSame($name, $cos->getName());
        $this->assertSame([$zimlet], $cos->getZimlets());

        $cos = new StubZimletStatusCos();
        $cos->setName($name)
            ->setZimlets([$zimlet]);
        $this->assertSame($name, $cos->getName());
        $this->assertSame([$zimlet], $cos->getZimlets());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, StubZimletStatusCos::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubZimletStatusCos extends ZimletStatusCos
{
}
