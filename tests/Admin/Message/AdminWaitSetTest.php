<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Response;

use Zimbra\Admin\Message\{AdminWaitSetBody, AdminWaitSetEnvelope, AdminWaitSetRequest, AdminWaitSetResponse};
use Zimbra\Common\Enum\InterestType;
use Zimbra\Mail\Struct\{AccountWithModifications, CreateItemNotification, DeleteItemNotification, ImapMessageInfo, ModifyItemNotification, ModifyTagNotification, PendingFolderModifications, RenameFolderNotification};
use Zimbra\Common\Struct\{Id, IdAndType, WaitSetAddSpec};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminWaitSetResponse.
 */
class AdminWaitSetResponseTest extends ZimbraTestCase
{
    public function testAdminWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = $this->faker->word;
        $timeout = $this->faker->randomNumber;
        $name = $this->faker->word;
        $id = $this->faker->randomNumber;
        $uid = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $seqNo = $this->faker->word;
        $type = $this->faker->word;

        $folderId = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = $this->faker->randomNumber;
        $lastChangeId = $this->faker->randomNumber;

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
            $waitSetId, $lastKnownSeqNo, FALSE, FALSE, $defaultInterests, $timeout, [$add], [$update], [$remove]
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

        $request = new AdminWaitSetRequest();
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

        $response = new AdminWaitSetResponse(
            $waitSetId, FALSE, $seqNo, [$account], [$error]
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertFalse($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());
        $this->assertSame([$account], $response->getSignalledAccounts());
        $this->assertSame([$error], $response->getErrors());

        $response = new AdminWaitSetResponse();
        $response->setWaitSetId($waitSetId)
            ->setCanceled(TRUE)
            ->setSeqNo($seqNo)
            ->setSignalledAccounts([$account, $account])
            ->setErrors([$error, $error]);
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertTrue($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());
        $this->assertSame([$account, $account], $response->getSignalledAccounts());
        $this->assertSame([$error, $error], $response->getErrors());

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

        $envelope = new AdminWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AdminWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:AdminWaitSetRequest waitSet="$waitSetId" seq="$lastKnownSeqNo" block="true" expand="true" defTypes="$defaultInterests" timeout="$timeout">
            <urn:add>
                <urn:a name="$name" id="$uid" token="$token" types="f,m" />
            </urn:add>
            <urn:update>
                <urn:a name="$name" id="$uid" token="$token" types="f,m" />
            </urn:update>
            <urn:remove>
                <urn:a id="$uid" />
            </urn:remove>
        </urn:AdminWaitSetRequest>
        <urn:AdminWaitSetResponse waitSet="$waitSetId" canceled="true" seq="$seqNo">
            <urn:a id="$id" changeid="$lastChangeId">
                <urn1:mods id="$folderId">
                    <urn1:created>
                        <urn1:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn1:created>
                    <urn1:deleted id="$id" t="$type" />
                    <urn1:modMsgs change="$changeBitmask">
                        <urn1:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn1:modMsgs>
                    <urn1:modTags change="$changeBitmask">
                        <urn1:id>$id</urn1:id>
                        <urn1:name>$name</urn1:name>
                    </urn1:modTags>
                    <urn1:modFolders id="$folderId" path="$path" change="$changeBitmask" />
                </urn1:mods>
            </urn:a>
            <urn:error id="$uid" type="$type" />
        </urn:AdminWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AdminWaitSetEnvelope::class, 'xml'));
    }
}
