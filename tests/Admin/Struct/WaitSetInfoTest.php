<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountsAttrib;
use Zimbra\Admin\Struct\BufferedCommitInfo;
use Zimbra\Admin\Struct\SessionForWaitSet;
use Zimbra\Admin\Struct\WaitSetInfo;
use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Struct\IdAndType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for WaitSetInfo.
 */
class WaitSetInfoTest extends ZimbraStructTestCase
{
    public function testWaitSetInfo()
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
        $this->assertSame($waitSetId, $waitSet->getWaitSetId());
        $this->assertSame($owner, $waitSet->getOwner());
        $this->assertSame($defaultInterests, $waitSet->getDefaultInterests());
        $this->assertSame($lastAccessDate, $waitSet->getLastAccessDate());
        $this->assertSame([$error], $waitSet->getErrors());
        $this->assertSame($signalledAccounts, $waitSet->getSignalledAccounts());
        $this->assertSame($cbSeqNo, $waitSet->getCbSeqNo());
        $this->assertSame($currentSeqNo, $waitSet->getCurrentSeqNo());
        $this->assertSame($nextSeqNo, $waitSet->getNextSeqNo());
        $this->assertSame([$commit], $waitSet->getBufferedCommits());
        $this->assertSame([$session], $waitSet->getSessions());

        $waitSet = new WaitSetInfo('', '', '', 0);
        $waitSet->setWaitSetId($waitSetId)
            ->setOwner($owner)
            ->setDefaultInterests($defaultInterests)
            ->setLastAccessDate($lastAccessDate)
            ->setErrors([$error])
            ->addError($error)
            ->setSignalledAccounts($signalledAccounts)
            ->setCbSeqNo($cbSeqNo)
            ->setCurrentSeqNo($currentSeqNo)
            ->setNextSeqNo($nextSeqNo)
            ->setBufferedCommits([$commit])
            ->addBufferedCommit($commit)
            ->setSessions([$session])
            ->addSession($session);
        $this->assertSame($waitSetId, $waitSet->getWaitSetId());
        $this->assertSame($owner, $waitSet->getOwner());
        $this->assertSame($defaultInterests, $waitSet->getDefaultInterests());
        $this->assertSame($lastAccessDate, $waitSet->getLastAccessDate());
        $this->assertSame([$error, $error], $waitSet->getErrors());
        $this->assertSame($signalledAccounts, $waitSet->getSignalledAccounts());
        $this->assertSame($cbSeqNo, $waitSet->getCbSeqNo());
        $this->assertSame($currentSeqNo, $waitSet->getCurrentSeqNo());
        $this->assertSame($nextSeqNo, $waitSet->getNextSeqNo());
        $this->assertSame([$commit, $commit], $waitSet->getBufferedCommits());
        $this->assertSame([$session, $session], $waitSet->getSessions());
        $waitSet->setErrors([$error])
            ->setBufferedCommits([$commit])
            ->setSessions([$session]);

        $xml = <<<EOT
<?xml version="1.0"?>
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
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($waitSet, 'xml'));
        $this->assertEquals($waitSet, $this->serializer->deserialize($xml, WaitSetInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($waitSet, 'json'));
        $this->assertEquals($waitSet, $this->serializer->deserialize($json, WaitSetInfo::class, 'json'));
    }
}
