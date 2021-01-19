<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

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
use Zimbra\Enum\ZimletPresence;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountZimletInfo.
 */
class AccountZimletInfoTest extends ZimbraStructTestCase
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
            $baseUrl, ZimletPresence::ENABLED(), $priority
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

        $zimlet = new AccountZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $zimlet = new AccountZimletInfo();
        $zimlet->setZimletContext($zimletContext)
            ->setZimlet($zimletDesc)
            ->setZimletConfig($zimletConfig);
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $xml = <<<EOT
<?xml version="1.0"?>
<zimlet>
    <zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
    <zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
        <serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
        <include>$value</include>
        <includeCSS>$value</includeCSS>
    </zimlet>
    <zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
        <global>
            <property name="$name">$value</property>
        </global>
        <host name="$name">
            <property name="$name">$value</property>
        </host>
    </zimletConfig>
</zimlet>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, AccountZimletInfo::class, 'xml'));

        $json = json_encode([
            'zimletContext' => [
                'baseUrl' => $baseUrl,
                'priority' => $priority,
                'presence' => 'enabled',
            ],
            'zimlet' => [
                'name' => $name,
                'version' => $version,
                'description' => $description,
                'extension' => $extension,
                'target' => $target,
                'label' => $label,
                'serverExtension' => [
                    'hasKeyword' => $hasKeyword,
                    'extensionClass' => $extensionClass,
                    'regex' => $regex,
                ],
                'include' => [
                    '_content' => $value,
                ],
                'includeCSS' => [
                    '_content' => $value,
                ],
            ],
            'zimletConfig' => [
                'name' => $name,
                'version' => $version,
                'description' => $description,
                'extension' => $extension,
                'target' => $target,
                'label' => $label,
                'global' => [
                    'property' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                ],
                'host' => [
                    'name' => $name,
                    'property' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, AccountZimletInfo::class, 'json'));
    }
}
