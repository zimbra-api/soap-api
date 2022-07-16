<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Response;

use Zimbra\Common\Enum\InterestType;
use Zimbra\Common\Struct\{Id, IdAndType, WaitSetAddSpec};
use Zimbra\Mail\Message\{
    WaitSetBody, WaitSetEnvelope, WaitSetRequest, WaitSetResponse
};
use Zimbra\Mail\Struct\{
    AccountWithModifications, CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WaitSetResponse.
 */
class WaitSetResponseTest extends ZimbraTestCase
{
    public function testWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = implode(',', [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
            InterestType::CONTACTS()->getValue(),
        ]);
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

        $request = new WaitSetRequest(
            $waitSetId, $lastKnownSeqNo, FALSE, $defaultInterests, $timeout, FALSE, [$add], [$update], [$remove]
        );
        $this->assertSame($waitSetId, $request->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $request->getLastKnownSeqNo());
        $this->assertFalse($request->getBlock());
        $this->assertFalse($request->getExpand());
        $this->assertSame($defaultInterests, $request->getDefaultInterests());
        $this->assertSame($timeout, $request->getTimeout());
        $this->assertSame([$add], $request->getAddAccounts());
        $this->assertSame([$update], $request->getUpdateAccounts());
        $this->assertSame([$remove], $request->getRemoveAccounts());

        $request = new WaitSetRequest();
        $request->setWaitSetId($waitSetId)
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
        $this->assertSame($waitSetId, $request->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $request->getLastKnownSeqNo());
        $this->assertTrue($request->getBlock());
        $this->assertTrue($request->getExpand());
        $this->assertSame($defaultInterests, $request->getDefaultInterests());
        $this->assertSame($timeout, $request->getTimeout());
        $this->assertSame([$add, $add], $request->getAddAccounts());
        $this->assertSame([$update, $update], $request->getUpdateAccounts());
        $this->assertSame([$remove, $remove], $request->getRemoveAccounts());

        $response = new WaitSetResponse(
            $waitSetId, FALSE, $seqNo, [$account], [$error]
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertFalse($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());
        $this->assertSame([$account], $response->getSignalledAccounts());
        $this->assertSame([$error], $response->getErrors());

        $response = new WaitSetResponse();
        $response->setWaitSetId($waitSetId)
            ->setCanceled(TRUE)
            ->setSeqNo($seqNo)
            ->setSignalledAccounts([$account])
            ->addSignalledAccount($account)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertTrue($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());
        $this->assertSame([$account, $account], $response->getSignalledAccounts());
        $this->assertSame([$error, $error], $response->getErrors());

        $request = new WaitSetRequest(
            $waitSetId, $lastKnownSeqNo, TRUE, $defaultInterests, $timeout, TRUE, [$add], [$update], [$remove]
        );
        $response = new WaitSetResponse(
            $waitSetId, TRUE, $seqNo, [$account], [$error]
        );

        $body = new WaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new WaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new WaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new WaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:WaitSetRequest waitSet="$waitSetId" seq="$lastKnownSeqNo" block="true" defTypes="$defaultInterests" timeout="$timeout" expand="true">
            <urn:add>
                <urn:a name="$name" id="$uid" token="$token" types="f,m" />
            </urn:add>
            <urn:update>
                <urn:a name="$name" id="$uid" token="$token" types="f,m" />
            </urn:update>
            <urn:remove>
                <urn:a id="$uid" />
            </urn:remove>
        </urn:WaitSetRequest>
        <urn:WaitSetResponse waitSet="$waitSetId" canceled="true" seq="$seqNo">
            <urn:a id="$id" changeid="$lastChangeId">
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
            </urn:a>
            <urn:error id="$uid" type="$type" />
        </urn:WaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, WaitSetEnvelope::class, 'xml'));
    }
}
