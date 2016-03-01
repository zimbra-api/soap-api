<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FolderSpec;

/**
 * Testcase class for FolderSpec.
 */
class FolderSpecTest extends ZimbraMailTestCase
{
    public function testFolderSpec()
    {
        $folder = $this->faker->word;
        $spec = new FolderSpec(
            $folder
        );
        $this->assertSame($folder, $spec->getFolder());

        $spec->setFolder($folder);
        $this->assertSame($folder, $spec->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<folder l="' . $folder . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $spec);

        $array = array(
            'folder' => array(
                'l' => $folder,
            ),
        );
        $this->assertEquals($array, $spec->toArray());
    }
}
