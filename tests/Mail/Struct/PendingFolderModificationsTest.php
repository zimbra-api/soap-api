<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Mail\Struct\{CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PendingFolderModifications.
 */
class PendingFolderModificationsTest extends ZimbraTestCase
{
    public function testPendingFolderModifications()
    {
        $id = mt_rand(1, 99);
        $name = $this->faker->word;
        $folderId = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $type = $this->faker->word;
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = mt_rand(1, 99);

        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new CreateItemNotification($msgInfo);
        $deleted = new DeleteItemNotification($id, $type);
        $modMsg = new ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new RenameFolderNotification($folderId, $path, $changeBitmask);

        $mods = new PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);
        $this->assertSame($folderId, $mods->getFolderId());
        $this->assertSame([$created], $mods->getCreated());
        $this->assertSame([$deleted], $mods->getDeleted());
        $this->assertSame([$modMsg], $mods->getModifiedMsgs());
        $this->assertSame([$modTag], $mods->getModifiedTags());
        $this->assertSame([$modFolder], $mods->getRenamedFolders());

        $mods = new PendingFolderModifications(0);
        $mods->setFolderId($folderId)
              ->setCreated([$created])
              ->addCreatedItem($created)
              ->setDeleted([$deleted])
              ->addDeletedItem($deleted)
              ->setModifiedMsgs([$modMsg])
              ->addModifiedMsg($modMsg)
              ->setModifiedTags([$modTag])
              ->addModifiedTag($modTag)
              ->setRenamedFolders([$modFolder])
              ->addRenamedFolder($modFolder);

        $this->assertSame($folderId, $mods->getFolderId());
        $this->assertSame([$created, $created], $mods->getCreated());
        $this->assertSame([$deleted, $deleted], $mods->getDeleted());
        $this->assertSame([$modMsg, $modMsg], $mods->getModifiedMsgs());
        $this->assertSame([$modTag, $modTag], $mods->getModifiedTags());
        $this->assertSame([$modFolder, $modFolder], $mods->getRenamedFolders());

        $mods = new PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$folderId">
    <created>
        <m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
    </created>
    <deleted id="$id" t="$type" />
    <modMsgs change="$changeBitmask">
        <m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
    </modMsgs>
    <modTags change="$changeBitmask">
        <id>$id</id>
        <name>$name</name>
    </modTags>
    <modFolders id="$folderId" path="$path" change="$changeBitmask" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mods, 'xml'));
        $this->assertEquals($mods, $this->serializer->deserialize($xml, PendingFolderModifications::class, 'xml'));

        $json = json_encode([
            'id' => $folderId,
            'created' => [
                [
                    'm' => [
                        'id' => $id,
                        'i4uid' => $imapUid,
                        't' => $type,
                        'f' => $flags,
                        'tn' => $tags,
                    ],
                ],
            ],
            'deleted' => [
                [
                    'id' => $id,
                    't' => $type,
                ],
            ],
            'modMsgs' => [
                [
                    'change' => $changeBitmask,
                    'm' => [
                        'id' => $id,
                        'i4uid' => $imapUid,
                        't' => $type,
                        'f' => $flags,
                        'tn' => $tags,
                    ],
                ],
            ],
            'modTags' => [
                [
                    'change' => $changeBitmask,
                    'id' => [
                        '_content' => $id,
                    ],
                    'name' => [
                        '_content' => $name,
                    ],
                ],
            ],
            'modFolders' => [
                [
                    'change' => $changeBitmask,
                    'id' => $folderId,
                    'path' => $path,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mods, 'json'));
        $this->assertEquals($mods, $this->serializer->deserialize($json, PendingFolderModifications::class, 'json'));
    }
}
