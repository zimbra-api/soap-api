<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RenameFolderNotification;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RenameFolderNotification.
 */
class RenameFolderNotificationTest extends ZimbraTestCase
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
<result id="$folderId" path="$path" change="$changeBitmask" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, RenameFolderNotification::class, 'xml'));
    }
}
