<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FileIntoAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FileIntoAction.
 */
class FileIntoActionTest extends ZimbraTestCase
{
    public function testFileIntoAction()
    {
        $index = mt_rand(1, 99);
        $folder = $this->faker->word;

        $action = new FileIntoAction($index, $folder, FALSE);
        $this->assertSame($folder, $action->getFolder());
        $this->assertFalse($action->isCopy());

        $action = new FileIntoAction($index);
        $action->setFolder($folder)
            ->setCopy(TRUE);
        $this->assertSame($folder, $action->getFolder());
        $this->assertTrue($action->isCopy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" folderPath="$folder" copy="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FileIntoAction::class, 'xml'));
    }
}
