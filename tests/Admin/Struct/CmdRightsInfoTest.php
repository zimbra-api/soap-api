<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $cmd = new CmdRightsInfo($name, [$right], [$note1, $note2]);
        $this->assertSame($name, $cmd->getName());
        $this->assertSame([$right], $cmd->getRights());
        $this->assertSame([$note1, $note2], $cmd->getNotes());

        $cmd = new CmdRightsInfo();
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
<result name="$name">
    <rights>
        <right name="$name" />
    </rights>
    <desc>
        <note>$note1</note>
        <note>$note2</note>
    </desc>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cmd, 'xml'));
        $this->assertEquals($cmd, $this->serializer->deserialize($xml, CmdRightsInfo::class, 'xml'));
    }
}
