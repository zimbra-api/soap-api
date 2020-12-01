<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FileIntoAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FileIntoAction.
 */
class FileIntoActionTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionFileInto index="' . $index . '" folderPath="' . $folder . '" copy="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FileIntoAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'folderPath' => $folder,
            'copy' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, FileIntoAction::class, 'json'));
    }
}
