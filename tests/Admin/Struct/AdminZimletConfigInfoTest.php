<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminZimletConfigInfo;
use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletHostConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletConfigInfo.
 */
class AdminZimletConfigInfoTest extends ZimbraTestCase
{
    public function testAdminZimletConfigInfo()
    {
        $name = $this->faker->word;
        $version = $this->faker->word;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $value = $this->faker->word;

        $property = new AdminZimletProperty($name, $value);
        $global = new AdminZimletGlobalConfigInfo([$property]);
        $host = new AdminZimletHostConfigInfo($name, [$property]);

        $zimletConfig = new StubAdminZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $this->assertSame($name, $zimletConfig->getName());
        $this->assertSame($version, $zimletConfig->getVersion());
        $this->assertSame($description, $zimletConfig->getDescription());
        $this->assertSame($extension, $zimletConfig->getExtension());
        $this->assertSame($target, $zimletConfig->getTarget());
        $this->assertSame($label, $zimletConfig->getLabel());

        $zimletConfig = new StubAdminZimletConfigInfo();
        $zimletConfig->setName($name)
            ->setVersion($version)
            ->setDescription($description)
            ->setExtension($extension)
            ->setTarget($target)
            ->setLabel($label)
            ->setGlobal($global)
            ->setHost($host);
        $this->assertSame($name, $zimletConfig->getName());
        $this->assertSame($version, $zimletConfig->getVersion());
        $this->assertSame($description, $zimletConfig->getDescription());
        $this->assertSame($extension, $zimletConfig->getExtension());
        $this->assertSame($target, $zimletConfig->getTarget());
        $this->assertSame($label, $zimletConfig->getLabel());
        $this->assertSame($global, $zimletConfig->getGlobal());
        $this->assertSame($host, $zimletConfig->getHost());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label" xmlns:urn="urn:zimbraAdmin">
    <urn:global>
        <urn:property name="$name">$value</urn:property>
    </urn:global>
    <urn:host name="$name">
        <urn:property name="$name">$value</urn:property>
    </urn:host>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimletConfig, 'xml'));
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($xml, StubAdminZimletConfigInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubAdminZimletConfigInfo extends AdminZimletConfigInfo
{
}
