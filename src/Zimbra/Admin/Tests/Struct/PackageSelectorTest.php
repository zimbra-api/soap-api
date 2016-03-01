<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\PackageSelector;

/**
 * Testcase class for PackageSelector.
 */
class PackageSelectorTest extends ZimbraAdminTestCase
{
    public function testPackageSelector()
    {
        $name = $this->faker->word;
        $package = new PackageSelector($name);
        $this->assertSame($name, $package->getName());

        $package->setName($name);
        $this->assertSame($name, $package->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<package name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $package);

        $array = [
            'package' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $package->toArray());
    }
}
