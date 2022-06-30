<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\{
    AccountWithModifications,
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
 * Testcase class for AccountWithModifications.
 */
class AccountWithModificationsTest extends ZimbraTestCase
{
    public function testAccountWithModifications()
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
        $lastChangeId = mt_rand(1, 99);

        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new CreateItemNotification($msgInfo);
        $deleted = new DeleteItemNotification($id, $type);
        $modMsg = new ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new RenameFolderNotification($folderId, $path, $changeBitmask);
        $mod = new PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);

        $account = new StubAccountWithModifications($id, [$mod], $lastChangeId);
        $this->assertSame($id, $account->getId());
        $this->assertSame([$mod], $account->getPendingFolderModifications());
        $this->assertSame($lastChangeId, $account->getLastChangeId());

        $account = new StubAccountWithModifications();
        $account->setId($id)
                ->setPendingFolderModifications([$mod])
                ->addPendingFolderModification($mod)
                ->setLastChangeId($lastChangeId);
        $this->assertSame($id, $account->getId());
        $this->assertSame([$mod, $mod], $account->getPendingFolderModifications());
        $this->assertSame($lastChangeId, $account->getLastChangeId());

        $account = new StubAccountWithModifications($id, [$mod], $lastChangeId);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" changeid="$lastChangeId" xmlns:urn="urn:zimbraMail">
    <urn:mods id="$folderId">
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
    </urn:mods>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($account, 'xml'));
        $this->assertEquals($account, $this->serializer->deserialize($xml, StubAccountWithModifications::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubAccountWithModifications extends AccountWithModifications
{
}
