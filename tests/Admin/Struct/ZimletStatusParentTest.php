<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $zimlets = new StubZimletStatusParent([$zimlet]);
        $this->assertSame([$zimlet], $zimlets->getZimlets());

        $zimlets = new StubZimletStatusParent();
        $zimlets->setZimlets([$zimlet]);
        $this->assertSame([$zimlet], $zimlets->getZimlets());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlets, 'xml'));
        $this->assertEquals($zimlets, $this->serializer->deserialize($xml, StubZimletStatusParent::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubZimletStatusParent extends ZimletStatusParent
{
}
