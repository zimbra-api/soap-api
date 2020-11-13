<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\PackageSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PackageSelector.
 */
class PackageSelectorTest extends ZimbraStructTestCase
{
    public function testPackageSelector()
    {
        $name = $this->faker->word;
        $package = new PackageSelector($name);
        $this->assertSame($name, $package->getName());

        $package = new PackageSelector('');
        $package->setName($name);
        $this->assertSame($name, $package->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<package name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($package, 'xml'));
        $this->assertEquals($package, $this->serializer->deserialize($xml, PackageSelector::class, 'xml'));

        $json = json_encode([
            'name' => $name,
        ]);
        $this->assertSame($json, $this->serializer->serialize($package, 'json'));
        $this->assertEquals($package, $this->serializer->deserialize($json, PackageSelector::class, 'json'));
    }
}
