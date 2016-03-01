<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FileIntoAction;

/**
 * Testcase class for FileIntoAction.
 */
class FileIntoActionTest extends ZimbraMailTestCase
{
    public function testFileIntoAction()
    {
        $index = mt_rand(1, 10);
        $folder = $this->faker->word;

        $actionFileInto = new FileIntoAction(
            $index, $folder
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionFileInto);
        $this->assertSame($folder, $actionFileInto->getFolder());
        $actionFileInto->setFolder($folder);
        $this->assertSame($folder, $actionFileInto->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionFileInto index="' . $index . '" folderPath="' . $folder . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFileInto);

        $array = array(
            'actionFileInto' => array(
                'index' => $index,
                'folderPath' => $folder,
            ),
        );
        $this->assertEquals($array, $actionFileInto->toArray());
    }
}
