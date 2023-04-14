<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\AccountZimletConfigInfo;
use Zimbra\Account\Struct\AccountZimletGlobalConfigInfo;
use Zimbra\Account\Struct\AccountZimletHostConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletConfigInfo.
 */
class AccountZimletConfigInfoTest extends ZimbraTestCase
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

        $zimletConfig = new MockAccountZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $this->assertSame($name, $zimletConfig->getName());
        $this->assertSame($version, $zimletConfig->getVersion());
        $this->assertSame($description, $zimletConfig->getDescription());
        $this->assertSame($extension, $zimletConfig->getExtension());
        $this->assertSame($target, $zimletConfig->getTarget());
        $this->assertSame($label, $zimletConfig->getLabel());

        $zimletConfig = new MockAccountZimletConfigInfo();
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
<result name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label" xmlns:urn="urn:zimbraAccount">
    <urn:global>
        <urn:property name="$name">$value</urn:property>
    </urn:global>
    <urn:host name="$name">
        <urn:property name="$name">$value</urn:property>
    </urn:host>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimletConfig, 'xml'));
        $this->assertEquals($zimletConfig, $this->serializer->deserialize($xml, MockAccountZimletConfigInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockAccountZimletConfigInfo extends AccountZimletConfigInfo
{
}
