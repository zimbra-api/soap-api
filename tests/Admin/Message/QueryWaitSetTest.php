<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\QueryWaitSetBody;
use Zimbra\Admin\Message\QueryWaitSetEnvelope;
use Zimbra\Admin\Message\QueryWaitSetRequest;
use Zimbra\Admin\Message\QueryWaitSetResponse;
use Zimbra\Admin\Struct\AccountsAttrib;
use Zimbra\Admin\Struct\BufferedCommitInfo;
use Zimbra\Admin\Struct\SessionForWaitSet;
use Zimbra\Admin\Struct\WaitSetInfo;
use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Common\Struct\IdAndType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueryWaitSetTest.
 */
class QueryWaitSetTest extends ZimbraTestCase
{
    public function testQueryWaitSet()
    {
        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $waitSetId = $this->faker->uuid;
        $owner = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $lastAccessDate = mt_rand(1, 100);
        $accounts = $this->faker->word;
        $cbSeqNo = $this->faker->word;
        $currentSeqNo = $this->faker->word;
        $nextSeqNo = $this->faker->word;
        $aid = $this->faker->uuid;
        $cid = $this->faker->uuid;

        $account = $this->faker->uuid;
        $interests = $this->faker->word;
        $mboxSyncToken = mt_rand(1, 100);
        $mboxSyncTokenDiff = mt_rand(1, 100);
        $acctIdError = $this->faker->uuid;

        $interestMask = $this->faker->word;
        $highestChangeId = mt_rand(1, 100);
        $lastAccessTime = mt_rand(1, 100);
        $creationTime = mt_rand(1, 100);
        $sessionId = $this->faker->uuid;
        $token = $this->faker->uuid;
        $folderInterests = $this->faker->word;
        $changedFolders = $this->faker->word;

        $request = new QueryWaitSetRequest($waitSetId);
        $this->assertSame($waitSetId, $request->getWaitSetId());
        $request = new QueryWaitSetRequest();
        $request->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $request->getWaitSetId());

        $error = new IdAndType($id, $type);
        $signalledAccounts = new AccountsAttrib($accounts);
        $commit = new BufferedCommitInfo($aid, $cid);
        $WaitSetSession = new WaitSetSessionInfo(
            $interestMask, $highestChangeId, $lastAccessTime, $creationTime, $sessionId, $token, $folderInterests, $changedFolders
        );
        $session = new SessionForWaitSet(
            $account, $interests, $token, $mboxSyncToken, $mboxSyncTokenDiff, $acctIdError, $WaitSetSession
        );
        $waitSet = new WaitSetInfo(
            $waitSetId, $owner, $defaultInterests, $lastAccessDate, [$error], $signalledAccounts, $cbSeqNo, $currentSeqNo, $nextSeqNo, [$commit], [$session]
        );
        $response = new QueryWaitSetResponse([$waitSet]);
        $this->assertSame([$waitSet], $response->getWaitsets());
        $response = new QueryWaitSetResponse();
        $response->setWaitsets([$waitSet])
            ->addWaitset($waitSet);
        $this->assertSame([$waitSet, $waitSet], $response->getWaitsets());
        $response->setWaitsets([$waitSet]);

        $body = new QueryWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new QueryWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new QueryWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new QueryWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:QueryWaitSetRequest waitSet="$waitSetId"/>
        <urn:QueryWaitSetResponse>
            <waitSet id="$waitSetId" owner="$owner" defTypes="$defaultInterests" ld="$lastAccessDate" cbSeqNo="$cbSeqNo" currentSeqNo="$currentSeqNo" nextSeqNo="$nextSeqNo">
                <errors>
                    <error id="$id" type="$type" />
                </errors>
                <ready accounts="$accounts" />
                <buffered>
                    <commit aid="$aid" cid="$cid" />
                </buffered>
                <session account="$account" types="$interests" token="$token" mboxSyncToken="$mboxSyncToken" mboxSyncTokenDiff="$mboxSyncTokenDiff" acctIdError="$acctIdError">
                    <WaitSetSession interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
                </session>
            </waitSet>
        </urn:QueryWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, QueryWaitSetEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'QueryWaitSetRequest' => [
                    'waitSet' => $waitSetId,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'QueryWaitSetResponse' => [
                    'waitSet' => [
                        [
                            'id' => $waitSetId,
                            'owner' => $owner,
                            'defTypes' => $defaultInterests,
                            'ld' => $lastAccessDate,
                            'cbSeqNo' => $cbSeqNo,
                            'currentSeqNo' => $currentSeqNo,
                            'nextSeqNo' => $nextSeqNo,
                            'errors' => [
                                'error' => [
                                    [
                                        'id' => $id,
                                        'type' => $type,
                                    ],
                                ],
                            ],
                            'ready' => [
                                'accounts' => $accounts,
                            ],
                            'buffered' => [
                                'commit' => [
                                    [
                                        'aid' => $aid,
                                        'cid' => $cid,
                                    ],
                                ],
                            ],
                            'session' => [
                                [
                                    'account' => $account,
                                    'types' => $interests,
                                    'token' => $token,
                                    'mboxSyncToken' => $mboxSyncToken,
                                    'mboxSyncTokenDiff' => $mboxSyncTokenDiff,
                                    'acctIdError' => $acctIdError,
                                    'WaitSetSession' => [
                                        'interestMask' => $interestMask,
                                        'highestChangeId' => $highestChangeId,
                                        'lastAccessTime' => $lastAccessTime,
                                        'creationTime' => $creationTime,
                                        'sessionId' => $sessionId,
                                        'token' => $token,
                                        'folderInterests' => $folderInterests,
                                        'changedFolders' => $changedFolders,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, QueryWaitSetEnvelope::class, 'json'));
    }
}
