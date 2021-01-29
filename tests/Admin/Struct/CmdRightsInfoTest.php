<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CmdRightsInfo;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for CmdRightsInfo.
 */
class CmdRightsInfoTest extends ZimbraStructTestCase
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
<cmd name="$name">
    <rights>
        <right name="$name" />
    </rights>
    <desc>
        <note>$note1</note>
        <note>$note2</note>
    </desc>
</cmd>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cmd, 'xml'));
        $this->assertEquals($cmd, $this->serializer->deserialize($xml, CmdRightsInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cmd, 'json'));
        $this->assertEquals($cmd, $this->serializer->deserialize($json, CmdRightsInfo::class, 'json'));
    }
}
