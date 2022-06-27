<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\GetFolderSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFolderSpec.
 */
class GetFolderSpecTest extends ZimbraTestCase
{
    public function testGetFolderSpec()
    {
        $uuid = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $path = $this->faker->word;

        $folder = new GetFolderSpec($uuid, $folderId, $path);
        $this->assertSame($uuid, $folder->getUuid());
        $this->assertSame($folderId, $folder->getFolderId());
        $this->assertSame($path, $folder->getPath());

        $folder = new GetFolderSpec();
        $folder->setUuid($uuid)
             ->setFolderId($folderId)
             ->setPath($path);
        $this->assertSame($uuid, $folder->getUuid());
        $this->assertSame($folderId, $folder->getFolderId());
        $this->assertSame($path, $folder->getPath());

        $xml = <<<EOT
<?xml version="1.0"?>
<result uuid="$uuid" l="$folderId" path="$path" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, GetFolderSpec::class, 'xml'));
    }
}
