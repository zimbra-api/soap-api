<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletConfigInfo;
use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletHostConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletConfigInfo.
 */
class AdminZimletConfigInfoTest extends ZimbraStructTestCase
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

        $zimletConfig = new AdminZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $this->assertSame($name, $zimletConfig->getName());
        $this->assertSame($version, $zimletConfig->getVersion());
        $this->assertSame($description, $zimletConfig->getDescription());
        $this->assertSame($extension, $zimletConfig->getExtension());
        $this->assertSame($target, $zimletConfig->getTarget());
        $this->assertSame($label, $zimletConfig->getLabel());

        $zimletConfig = new AdminZimletConfigInfo();
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
<zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
    <global>
        <property name="$name">$value</property>
    </global>
    <host name="$name">
        <property name="$name">$value</property>
    </host>
</zimletConfig>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimletConfig, 'xml'));
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($xml, AdminZimletConfigInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimletConfig, 'json'));
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($json, AdminZimletConfigInfo::class, 'json'));
    }
}
