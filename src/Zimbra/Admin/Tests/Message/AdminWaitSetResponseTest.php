<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminWaitSetResponse;
use Zimbra\Struct\IdAndType;
use Zimbra\Mail\Struct\{AccountWithModifications, CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminWaitSetResponse.
 */
class AdminWaitSetResponseTest extends ZimbraStructTestCase
{
    public function testAdminWaitSetResponse()
    {
        $waitSetId = $this->faker->uuid;
        $seqNo = $this->faker->word;
        $uid = $this->faker->uuid;
        $type = $this->faker->word;

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
        $error = new IdAndType($uid, $type);

        $res = new AdminWaitSetResponse(
            $waitSetId, FALSE, $seqNo, [$account], [$error]
        );
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertFalse($res->getCanceled());
        $this->assertSame($seqNo, $res->getSeqNo());
        $this->assertSame([$account], $res->getSignalledAccounts());
        $this->assertSame([$error], $res->getErrors());

        $res = new AdminWaitSetResponse('');
        $res->setWaitSetId($waitSetId)
            ->setCanceled(TRUE)
            ->setSeqNo($seqNo)
            ->setSignalledAccounts([$account])
            ->addSignalledAccount($account)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertTrue($res->getCanceled());
        $this->assertSame($seqNo, $res->getSeqNo());
        $this->assertSame([$account, $account], $res->getSignalledAccounts());
        $this->assertSame([$error, $error], $res->getErrors());

        $res = new AdminWaitSetResponse(
            $waitSetId, TRUE, $seqNo, [$account], [$error]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminWaitSetResponse waitSet="' . $waitSetId . '" canceled="true" seq="' . $seqNo . '">'
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
                . '</a>'
                . '<error id="' . $uid . '" type="' . $type . '" />'
            . '</AdminWaitSetResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AdminWaitSetResponse::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
            'canceled' => TRUE,
            'seq' => $seqNo,
            'a' => [
                [
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
                ],
            ],
            'error' => [
                [
                    'id' => $uid,
                    'type' => $type,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AdminWaitSetResponse::class, 'json'));
    }
}
