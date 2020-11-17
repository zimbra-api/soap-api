<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\{AdminWaitSetBody, AdminWaitSetEnvelope, AdminWaitSetRequest, AdminWaitSetResponse};
use Zimbra\Enum\InterestType;
use Zimbra\Mail\Struct\{AccountWithModifications, CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification};
use Zimbra\Struct\{Id, IdAndType, WaitSetAddSpec};
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminWaitSetResponse.
 */
class AdminWaitSetResponseTest extends ZimbraStructTestCase
{
    public function testAdminWaitSetRequest()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = $this->faker->word;
        $timeout = mt_rand();
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $add = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $update = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $remove = new Id($id);

        $req = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, FALSE, FALSE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $this->assertSame($waitSetId, $req->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $req->getLastKnownSeqNo());
        $this->assertFalse($req->getBlock());
        $this->assertFalse($req->getExpand());
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());
        $this->assertSame([$add], $req->getAddAccounts());
        $this->assertSame([$update], $req->getUpdateAccounts());
        $this->assertSame([$remove], $req->getRemoveAccounts());

        $req = new AdminWaitSetRequest('', '');
        $req->setWaitSetId($waitSetId)
            ->setLastKnownSeqNo($lastKnownSeqNo)
            ->setBlock(TRUE)
            ->setExpand(TRUE)
            ->setDefaultInterests($defaultInterests)
            ->setTimeout($timeout)
            ->setAddAccounts([$add])
            ->addAddAccount($add)
            ->setUpdateAccounts([$update])
            ->addUpdateAccount($update)
            ->setRemoveAccounts([$remove])
            ->addRemoveAccount($remove);
        $this->assertSame($waitSetId, $req->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $req->getLastKnownSeqNo());
        $this->assertTrue($req->getBlock());
        $this->assertTrue($req->getExpand());
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());
        $this->assertSame([$add, $add], $req->getAddAccounts());
        $this->assertSame([$update, $update], $req->getUpdateAccounts());
        $this->assertSame([$remove, $remove], $req->getRemoveAccounts());

        $req = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, TRUE, TRUE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminWaitSetRequest waitSet="' . $waitSetId . '" seq="' . $lastKnownSeqNo . '" block="true" expand="true" defTypes="' . $defaultInterests . '" timeout="' . $timeout . '">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</add>'
                . '<update>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</update>'
                . '<remove>'
                    .'<a id="' . $id . '" />'
                . '</remove>'
            . '</AdminWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AdminWaitSetRequest::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
            'seq' => $lastKnownSeqNo,
            'block' => TRUE,
            'expand' => TRUE,
            'defTypes' => $defaultInterests,
            'timeout' => $timeout,
            'add' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ]
            ],
            'update' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ]
            ],
            'remove' => [
                'a' => [
                    [
                        'id' => $id,
                    ],
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AdminWaitSetRequest::class, 'json'));
    }

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

    public function testAdminWaitSetBody()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = $this->faker->word;
        $timeout = mt_rand();
        $name = $this->faker->word;
        $id = mt_rand(1, 99);
        $uid = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $seqNo = $this->faker->word;
        $type = $this->faker->word;

        $folderId = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = mt_rand(1, 99);
        $lastChangeId = mt_rand(1, 99);

        $add = new WaitSetAddSpec($name, $uid, $token, implode(',', $interests));
        $update = new WaitSetAddSpec($name, $uid, $token, implode(',', $interests));
        $remove = new Id($uid);

        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new CreateItemNotification($msgInfo);
        $deleted = new DeleteItemNotification($id, $type);
        $modMsg = new ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new RenameFolderNotification($folderId, $path, $changeBitmask);
        $mod = new PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);
        $account = new AccountWithModifications($id, [$mod], $lastChangeId);
        $error = new IdAndType($uid, $type);

        $request = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, TRUE, TRUE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $response = new AdminWaitSetResponse(
            $waitSetId, TRUE, $seqNo, [$account], [$error]
        );

        $body = new AdminWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AdminWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AdminWaitSetRequest waitSet="' . $waitSetId . '" seq="' . $lastKnownSeqNo . '" block="true" expand="true" defTypes="' . $defaultInterests . '" timeout="' . $timeout . '">'
                    . '<add>'
                        . '<a name="' . $name . '" id="' . $uid . '" token="' . $token . '" types="f,m" />'
                    . '</add>'
                    . '<update>'
                        . '<a name="' . $name . '" id="' . $uid . '" token="' . $token . '" types="f,m" />'
                    . '</update>'
                    . '<remove>'
                        .'<a id="' . $uid . '" />'
                    . '</remove>'
                . '</urn:AdminWaitSetRequest>'
                . '<urn:AdminWaitSetResponse waitSet="' . $waitSetId . '" canceled="true" seq="' . $seqNo . '">'
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
                . '</urn:AdminWaitSetResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AdminWaitSetBody::class, 'xml'));

        $json = json_encode([
            'AdminWaitSetRequest' => [
                'waitSet' => $waitSetId,
                'seq' => $lastKnownSeqNo,
                'block' => TRUE,
                'expand' => TRUE,
                'defTypes' => $defaultInterests,
                'timeout' => $timeout,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $uid,
                            'token' => $token,
                            'types' => 'f,m',
                        ],
                    ]
                ],
                'update' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $uid,
                            'token' => $token,
                            'types' => 'f,m',
                        ],
                    ]
                ],
                'remove' => [
                    'a' => [
                        [
                            'id' => $uid,
                        ],
                    ]
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AdminWaitSetResponse' => [
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
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AdminWaitSetBody::class, 'json'));
    }

    public function testAdminWaitSetEnvelope()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = $this->faker->word;
        $timeout = mt_rand();
        $name = $this->faker->word;
        $id = mt_rand(1, 99);
        $uid = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $seqNo = $this->faker->word;
        $type = $this->faker->word;

        $folderId = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = mt_rand(1, 99);
        $lastChangeId = mt_rand(1, 99);

        $add = new WaitSetAddSpec($name, $uid, $token, implode(',', $interests));
        $update = new WaitSetAddSpec($name, $uid, $token, implode(',', $interests));
        $remove = new Id($uid);

        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new CreateItemNotification($msgInfo);
        $deleted = new DeleteItemNotification($id, $type);
        $modMsg = new ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new RenameFolderNotification($folderId, $path, $changeBitmask);
        $mod = new PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);
        $account = new AccountWithModifications($id, [$mod], $lastChangeId);
        $error = new IdAndType($uid, $type);

        $request = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, TRUE, TRUE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $response = new AdminWaitSetResponse(
            $waitSetId, TRUE, $seqNo, [$account], [$error]
        );
        $body = new AdminWaitSetBody($request, $response);

        $envelope = new AdminWaitSetEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AdminWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AdminWaitSetRequest waitSet="' . $waitSetId . '" seq="' . $lastKnownSeqNo . '" block="true" expand="true" defTypes="' . $defaultInterests . '" timeout="' . $timeout . '">'
                        . '<add>'
                            . '<a name="' . $name . '" id="' . $uid . '" token="' . $token . '" types="f,m" />'
                        . '</add>'
                        . '<update>'
                            . '<a name="' . $name . '" id="' . $uid . '" token="' . $token . '" types="f,m" />'
                        . '</update>'
                        . '<remove>'
                            .'<a id="' . $uid . '" />'
                        . '</remove>'
                    . '</urn:AdminWaitSetRequest>'
                    . '<urn:AdminWaitSetResponse waitSet="' . $waitSetId . '" canceled="true" seq="' . $seqNo . '">'
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
                    . '</urn:AdminWaitSetResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AdminWaitSetEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AdminWaitSetRequest' => [
                    'waitSet' => $waitSetId,
                    'seq' => $lastKnownSeqNo,
                    'block' => TRUE,
                    'expand' => TRUE,
                    'defTypes' => $defaultInterests,
                    'timeout' => $timeout,
                    'add' => [
                        'a' => [
                            [
                                'name' => $name,
                                'id' => $uid,
                                'token' => $token,
                                'types' => 'f,m',
                            ],
                        ]
                    ],
                    'update' => [
                        'a' => [
                            [
                                'name' => $name,
                                'id' => $uid,
                                'token' => $token,
                                'types' => 'f,m',
                            ],
                        ]
                    ],
                    'remove' => [
                        'a' => [
                            [
                                'id' => $uid,
                            ],
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AdminWaitSetResponse' => [
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
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AdminWaitSetEnvelope::class, 'json'));
    }
}
