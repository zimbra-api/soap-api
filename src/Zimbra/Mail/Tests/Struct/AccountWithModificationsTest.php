<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\{AccountWithModifications, CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountWithModifications.
 */
class AccountWithModificationsTest extends ZimbraStructTestCase
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

        $account = new AccountWithModifications($id, [$mod], $lastChangeId);
        $this->assertSame($id, $account->getId());
        $this->assertSame([$mod], $account->getPendingFolderModifications());
        $this->assertSame($lastChangeId, $account->getLastChangeId());

        $account = new AccountWithModifications();
        $account->setId($id)
                ->setPendingFolderModifications([$mod])
                ->addPendingFolderModification($mod)
                ->setLastChangeId($lastChangeId);
        $this->assertSame($id, $account->getId());
        $this->assertSame([$mod, $mod], $account->getPendingFolderModifications());
        $this->assertSame($lastChangeId, $account->getLastChangeId());

        $account = new AccountWithModifications($id, [$mod], $lastChangeId);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a id="' . $id . '" changeid="' . $lastChangeId . '">'
                . '<mods id="' . $folderId . '">'
                    . '<created>'
                        . '<m id="' . $id . '" i4uid="' . $imapUid . '" t="' . $type . '" f="' . $flags . '" tn="' . $tags . '" />'
                    . '</created>'
                    . '<deleted id="' . $id . '" t="' . $type . '" />'
                    . '<modMsgs change="' . $changeBitmask . '">'
                        . '<m id="' . $id . '" i4uid="' . $imapUid . '" t="' . $type . '" f="' . $flags . '" tn="' . $tags . '" />'
                    . '</modMsgs>'
                    . '<modTags change="' . $changeBitmask . '">'
                        . '<id>' . $id . '</id>'
                        . '<name>' . $name . '</name>'
                    . '</modTags>'
                    . '<modFolders id="' . $folderId . '" path="' . $path . '" change="' . $changeBitmask . '" />'
                . '</mods>'
            . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($account, 'xml'));
        $this->assertEquals($account, $this->serializer->deserialize($xml, AccountWithModifications::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'mods' => [
                [
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
                ],
            ],
            'changeid' => $lastChangeId,
        ]);
        $this->assertSame($json, $this->serializer->serialize($account, 'json'));
        $this->assertEquals($account, $this->serializer->deserialize($json, AccountWithModifications::class, 'json'));
    }
}
