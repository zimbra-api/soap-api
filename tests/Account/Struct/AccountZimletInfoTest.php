<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\AccountZimletInfo;
use Zimbra\Account\Struct\AccountZimletContext;
use Zimbra\Account\Struct\AccountZimletDesc;
use Zimbra\Account\Struct\AccountZimletInclude;
use Zimbra\Account\Struct\AccountZimletIncludeCSS;
use Zimbra\Account\Struct\ZimletServerExtension;
use Zimbra\Account\Struct\AccountZimletConfigInfo;
use Zimbra\Account\Struct\AccountZimletGlobalConfigInfo;
use Zimbra\Account\Struct\AccountZimletHostConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletInfo.
 */
class AccountZimletInfoTest extends ZimbraTestCase
{
    public function testAccountZimletInfo()
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

        $zimletContext = new AccountZimletContext(
            $baseUrl, ZimletPresence::ENABLED, $priority
        );

        $serverExtension = new ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $include = new AccountZimletInclude($value);
        $includeCSS = new AccountZimletIncludeCSS($value);
        $zimletDesc = new AccountZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension($serverExtension)
            ->setZimletInclude($include)
            ->setZimletIncludeCSS($includeCSS);

        $property = new AccountZimletProperty($name, $value);
        $global = new AccountZimletGlobalConfigInfo([$property]);
        $host = new AccountZimletHostConfigInfo($name, [$property]);
        $zimletConfig = new AccountZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal($global)
            ->setHost($host);

        $zimlet = new MockAccountZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $zimlet = new MockAccountZimletInfo();
        $zimlet->setZimletContext($zimletContext)
            ->setZimlet($zimletDesc)
            ->setZimletConfig($zimletConfig);
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAccount">
    <urn:zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
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
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, MockAccountZimletInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockAccountZimletInfo extends AccountZimletInfo
{
}
