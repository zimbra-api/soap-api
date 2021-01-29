<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CmdRightsInfo;
use Zimbra\Admin\Struct\PackageRightsInfo;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PackageRightsInfo.
 */
class PackageRightsInfoTest extends ZimbraTestCase
{
    public function testPackageRightsInfo()
    {
        $name = $this->faker->word;
        $note1 = $this->faker->word;
        $note2 = $this->faker->word;

        $cmd = new CmdRightsInfo($name, [new NamedElement($name)], [$note1, $note2]);

        $package = new PackageRightsInfo($name, [$cmd]);
        $this->assertSame($name, $package->getName());
        $this->assertSame([$cmd], $package->getCmds());

        $package = new PackageRightsInfo();
        $package->setName($name)
            ->setCmds([$cmd])
            ->addCmd($cmd);
        $this->assertSame($name, $package->getName());
        $this->assertSame([$cmd, $cmd], $package->getCmds());
        $package->setCmds([$cmd]);

        $xml = <<<EOT
<?xml version="1.0"?>
<package name="$name">
    <cmd name="$name">
        <rights>
            <right name="$name" />
        </rights>
        <desc>
            <note>$note1</note>
            <note>$note2</note>
        </desc>
    </cmd>
</package>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($package, 'xml'));
        $this->assertEquals($package, $this->serializer->deserialize($xml, PackageRightsInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'cmd' => [
                [
                    'name' => $name,
                    'rights' => [
                        'right' => [
                            [
                                'name' => $name,
                            ],
                        ],
                    ],
                    'desc' => [
                        'note' => [
                            [
                                '_content' => $note1,
                            ],
                            [
                                '_content' => $note2,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($package, 'json'));
        $this->assertEquals($package, $this->serializer->deserialize($json, PackageRightsInfo::class, 'json'));
    }
}
