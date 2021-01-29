<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletConfigInfo;
use Zimbra\Account\Struct\AccountZimletGlobalConfigInfo;
use Zimbra\Account\Struct\AccountZimletHostConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AccountZimletConfigInfo.
 */
class AccountZimletConfigInfoTest extends ZimbraStructTestCase
{
    public function testAccountZimletConfigInfo()
    {
        $name = $this->faker->word;
        $version = $this->faker->word;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $value = $this->faker->word;

        $property = new AccountZimletProperty($name, $value);
        $global = new AccountZimletGlobalConfigInfo([$property]);
        $host = new AccountZimletHostConfigInfo($name, [$property]);

        $zimletConfig = new AccountZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $this->assertSame($name, $zimletConfig->getName());
        $this->assertSame($version, $zimletConfig->getVersion());
        $this->assertSame($description, $zimletConfig->getDescription());
        $this->assertSame($extension, $zimletConfig->getExtension());
        $this->assertSame($target, $zimletConfig->getTarget());
        $this->assertSame($label, $zimletConfig->getLabel());

        $zimletConfig = new AccountZimletConfigInfo();
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
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($xml, AccountZimletConfigInfo::class, 'xml'));

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
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($json, AccountZimletConfigInfo::class, 'json'));
    }
}
