<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CmdRightsInfo;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CmdRightsInfo.
 */
class CmdRightsInfoTest extends ZimbraTestCase
{
    public function testCmdRightsInfo()
    {
        $name = $this->faker->word;
        $note1 = $this->faker->word;
        $note2 = $this->faker->word;

        $right = new NamedElement($name);

        $cmd = new StubCmdRightsInfo($name, [$right], [$note1, $note2]);
        $this->assertSame($name, $cmd->getName());
        $this->assertSame([$right], $cmd->getRights());
        $this->assertSame([$note1, $note2], $cmd->getNotes());

        $cmd = new StubCmdRightsInfo();
        $cmd->setName($name)
            ->setRights([$right])
            ->addRight($right)
            ->setNotes([$note1])
            ->addNote($note2);
        $this->assertSame($name, $cmd->getName());
        $this->assertSame([$right, $right], $cmd->getRights());
        $this->assertSame([$note1, $note2], $cmd->getNotes());
        $cmd->setRights([$right]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:rights>
        <urn:right name="$name" />
    </urn:rights>
    <urn:desc>
        <urn:note>$note1</urn:note>
        <urn:note>$note2</urn:note>
    </urn:desc>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cmd, 'xml'));
        $this->assertEquals($cmd, $this->serializer->deserialize($xml, StubCmdRightsInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubCmdRightsInfo extends CmdRightsInfo
{
}
