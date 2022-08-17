<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\{
    CreateItemNotification,
    DeleteItemNotification,
    ImapMessageInfo,
    ModifyItemNotification,
    ModifyTagNotification,
    PendingFolderModifications,
    RenameFolderNotification
};
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

        $mods = new StubPendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);
        $this->assertSame($folderId, $mods->getFolderId());
        $this->assertSame([$created], $mods->getCreated());
        $this->assertSame([$deleted], $mods->getDeleted());
        $this->assertSame([$modMsg], $mods->getModifiedMsgs());
        $this->assertSame([$modTag], $mods->getModifiedTags());
        $this->assertSame([$modFolder], $mods->getRenamedFolders());

        $mods = new StubPendingFolderModifications();
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

        $mods = new StubPendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$folderId" xmlns:urn="urn:zimbraMail">
    <urn:created>
        <urn:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
    </urn:created>
    <urn:deleted id="$id" t="$type" />
    <urn:modMsgs change="$changeBitmask">
        <urn:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
    </urn:modMsgs>
    <urn:modTags change="$changeBitmask">
        <urn:id>$id</urn:id>
        <urn:name>$name</urn:name>
    </urn:modTags>
    <urn:modFolders id="$folderId" path="$path" change="$changeBitmask" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mods, 'xml'));
        $this->assertEquals($mods, $this->serializer->deserialize($xml, StubPendingFolderModifications::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubPendingFolderModifications extends PendingFolderModifications
{
}
