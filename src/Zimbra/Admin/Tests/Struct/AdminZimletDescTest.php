<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminZimletDesc;
use Zimbra\Admin\Struct\AdminZimletInclude;
use Zimbra\Admin\Struct\AdminZimletIncludeCSS;
use Zimbra\Admin\Struct\ZimletServerExtension;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletDesc.
 */
class AdminZimletDescTest extends ZimbraStructTestCase
{
    public function testAdminZimletDesc()
    {
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

        $serverExtension = new ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $include = new AdminZimletInclude($value);
        $includeCSS = new AdminZimletIncludeCSS($value);

        $zimlet = new AdminZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($version, $zimlet->getVersion());
        $this->assertSame($description, $zimlet->getDescription());
        $this->assertSame($extension, $zimlet->getExtension());
        $this->assertSame($target, $zimlet->getTarget());
        $this->assertSame($label, $zimlet->getLabel());

        $zimlet = new AdminZimletDesc();
        $zimlet->setName($name)
            ->setVersion($version)
            ->setDescription($description)
            ->setExtension($extension)
            ->setTarget($target)
            ->setLabel($label)
            ->setServerExtension($serverExtension)
            ->setZimletInclude($include)
            ->setZimletIncludeCSS($includeCSS);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($version, $zimlet->getVersion());
        $this->assertSame($description, $zimlet->getDescription());
        $this->assertSame($extension, $zimlet->getExtension());
        $this->assertSame($target, $zimlet->getTarget());
        $this->assertSame($label, $zimlet->getLabel());
        $this->assertSame($serverExtension, $zimlet->getServerExtension());
        $this->assertSame($include, $zimlet->getZimletInclude());
        $this->assertSame($includeCSS, $zimlet->getZimletIncludeCSS());

        $xml = <<<EOT
<?xml version="1.0"?>
<zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
    <serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
    <include>$value</include>
    <includeCSS>$value</includeCSS>
</zimlet>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, AdminZimletDesc::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, AdminZimletDesc::class, 'json'));
    }
}
