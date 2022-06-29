<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CmdRightsInfo;
use Zimbra\Admin\Struct\PackageRightsInfo;
use Zimbra\Common\Struct\NamedElement;
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

        $package = new StubPackageRightsInfo($name, [$cmd]);
        $this->assertSame($name, $package->getName());
        $this->assertSame([$cmd], $package->getCmds());

        $package = new StubPackageRightsInfo();
        $package->setName($name)
            ->setCmds([$cmd])
            ->addCmd($cmd);
        $this->assertSame($name, $package->getName());
        $this->assertSame([$cmd, $cmd], $package->getCmds());
        $package->setCmds([$cmd]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:cmd name="$name">
        <urn:rights>
            <urn:right name="$name" />
        </urn:rights>
        <urn:desc>
            <urn:note>$note1</urn:note>
            <urn:note>$note2</urn:note>
        </urn:desc>
    </urn:cmd>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($package, 'xml'));
        $this->assertEquals($package, $this->serializer->deserialize($xml, StubPackageRightsInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubPackageRightsInfo extends PackageRightsInfo
{
}
