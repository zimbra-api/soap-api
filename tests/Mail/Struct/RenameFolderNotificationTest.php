<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RenameFolderNotification;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RenameFolderNotification.
 */
class RenameFolderNotificationTest extends ZimbraStructTestCase
{
    public function testRenameFolderNotification()
    {
        $changeBitmask = mt_rand(1, 99);
        $folderId = mt_rand(1, 99);
        $path = $this->faker->word;
        $item = new RenameFolderNotification($folderId, $path, $changeBitmask);
        $this->assertSame($folderId, $item->getFolderId());
        $this->assertSame($path, $item->getPath());

        $item = new RenameFolderNotification(0, '', $changeBitmask);
        $item->setFolderId($folderId)
             ->setPath($path);
        $this->assertSame($folderId, $item->getFolderId());
        $this->assertSame($path, $item->getPath());

        $xml = <<<EOT
<?xml version="1.0"?>
<modFolders id="$folderId" path="$path" change="$changeBitmask" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, RenameFolderNotification::class, 'xml'));

        $json = json_encode([
            'change' => $changeBitmask,
            'id' => $folderId,
            'path' => $path,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $tags = $this->serializer->deserialize($json, RenameFolderNotification::class, 'json');
        $this->assertEquals($item, $this->serializer->deserialize($json, RenameFolderNotification::class, 'json'));
    }
}
