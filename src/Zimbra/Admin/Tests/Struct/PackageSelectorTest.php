<?php

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

        $package = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\PackageSelector', 'xml');
        $this->assertSame($name, $package->getName());
    }
}
