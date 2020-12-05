<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

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
use Zimbra\Enum\ZimletPresence;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletInfo.
 */
class AdminZimletInfoTest extends ZimbraStructTestCase
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
            $baseUrl, ZimletPresence::ENABLED(), $priority
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

        $zimlet = new AdminZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $zimlet = new AdminZimletInfo();
        $zimlet->setZimletContext($zimletContext)
            ->setZimlet($zimletDesc)
            ->setZimletConfig($zimletConfig);
        $this->assertSame($zimletContext, $zimlet->getZimletContext());
        $this->assertSame($zimletDesc, $zimlet->getZimlet());
        $this->assertSame($zimletConfig, $zimlet->getZimletConfig());

        $presence = ZimletPresence::ENABLED()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<zimlet>
    <zimletContext baseUrl="$baseUrl" priority="$priority" presence="$presence" />
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
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, AdminZimletInfo::class, 'xml'));

        $json = json_encode([
            'zimletContext' => [
                'baseUrl' => $baseUrl,
                'priority' => $priority,
                'presence' => $presence,
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
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, AdminZimletInfo::class, 'json'));
    }
}
