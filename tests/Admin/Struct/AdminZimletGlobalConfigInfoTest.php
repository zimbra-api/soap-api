<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletGlobalConfigInfo.
 */
class AdminZimletGlobalConfigInfoTest extends ZimbraTestCase
{
    public function testAdminZimletGlobalConfigInfo()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $property = new AdminZimletProperty($name, $value);

        $global = new StubAdminZimletGlobalConfigInfo([$property]);
        $this->assertSame([$property], $global->getZimletProperties());

        $global = new StubAdminZimletGlobalConfigInfo;
        $global->setZimletProperties([$property])
            ->addZimletProperty($property);
        $this->assertSame([$property, $property], $global->getZimletProperties());
        $global->setZimletProperties([$property]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:property name="$name">$value</urn:property>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($global, 'xml'));
        $this->assertEquals($global, $this->serializer->deserialize($xml, StubAdminZimletGlobalConfigInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubAdminZimletGlobalConfigInfo extends AdminZimletGlobalConfigInfo
{
}
