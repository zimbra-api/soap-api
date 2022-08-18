<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminZimletInfo;
use Zimbra\Admin\Struct\AdminZimletContext;
use Zimbra\Admin\Struct\AdminZimletDesc;
use Zimbra\Admin\Struct\AdminZimletInclude;
use Zimbra\Admin\Struct\AdminZimletIncludeCSS;
use Zimbra\Admin\Struct\ZimletServerExtension;
use Zimbra\Admin\Struct\AdminZimletConfigInfo;
use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletHostConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletInfo.
 */
class AdminZimletInfoTest extends ZimbraTestCase
{
    public function testAdminZimletInfo()
    {
        $baseUrl = $this->faker->word;
        $priority = mt_rand(1, 10);
        $name = $this->faker->word;
        $version = $this->faker->word;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $value = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $zimletContext = new AdminZimletContext(
            $baseUrl, ZimletPresence::ENABLED, $priority
        );

        $serverExtension = new ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $include = new AdminZimletInclude($value);
        $includeCSS = new AdminZimletIncludeCSS($value);
        $zimletDesc = new AdminZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension($serverExtension)
            ->setZimletInclude($include)
            ->setZimletIncludeCSS($includeCSS);

        $property = new AdminZimletProperty($name, $value);
        $global = new AdminZimletGlobalConfigInfo([$property]);
        $host = new AdminZimletHostConfigInfo($name, [$property]);
        $zimletConfig = new AdminZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal($global)
            ->setHost($host);

        $zimlet = new StubAdminZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $zimlet = new StubAdminZimletInfo();
        $zimlet->setZimletContext($zimletContext)
            ->setZimlet($zimletDesc)
            ->setZimletConfig($zimletConfig);
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $presence = ZimletPresence::ENABLED->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:zimletContext baseUrl="$baseUrl" priority="$priority" presence="$presence" />
    <urn:zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
        <urn:serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
        <urn:include>$value</urn:include>
        <urn:includeCSS>$value</urn:includeCSS>
    </urn:zimlet>
    <urn:zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
        <urn:global>
            <urn:property name="$name">$value</urn:property>
        </urn:global>
        <urn:host name="$name">
            <urn:property name="$name">$value</urn:property>
        </urn:host>
    </urn:zimletConfig>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, StubAdminZimletInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubAdminZimletInfo extends AdminZimletInfo
{
}
