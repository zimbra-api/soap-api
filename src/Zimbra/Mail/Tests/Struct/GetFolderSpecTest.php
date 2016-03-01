<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\GetFolderSpec;

/**
 * Testcase class for GetFolderSpec.
 */
class GetFolderSpecTest extends ZimbraMailTestCase
{
    public function testGetFolderSpec()
    {
        $uuid = $this->faker->uuid;
        $folder = $this->faker->word;
        $path = $this->faker->word;

        $spec = new GetFolderSpec(
            $uuid, $folder, $path
        );
        $this->assertSame($uuid, $spec->getUuid());
        $this->assertSame($folder, $spec->getFolderId());
        $this->assertSame($path, $spec->getPath());

        $spec->setUuid($uuid)
             ->setFolderId($folder)
             ->setPath($path);
        $this->assertSame($uuid, $spec->getUuid());
        $this->assertSame($folder, $spec->getFolderId());
        $this->assertSame($path, $spec->getPath());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<folder uuid="' . $uuid . '" l="' . $folder . '" path="' . $path . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $spec);

        $array = array(
            'folder' => array(
                'uuid' => $uuid,
                'l' => $folder,
                'path' => $path,
            ),
        );
        $this->assertEquals($array, $spec->toArray());
    }
}
