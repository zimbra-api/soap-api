<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\PackageSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PackageSelector.
 */
class PackageSelectorTest extends ZimbraTestCase
{
    public function testPackageSelector()
    {
        $name = $this->faker->word;
        $package = new PackageSelector($name);
        $this->assertSame($name, $package->getName());

        $package = new PackageSelector();
        $package->setName($name);
        $this->assertSame($name, $package->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($package, 'xml'));
        $this->assertEquals($package, $this->serializer->deserialize($xml, PackageSelector::class, 'xml'));
    }
}
