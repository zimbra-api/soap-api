<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AccountsAttrib;
use Zimbra\Admin\Struct\BufferedCommitInfo;
use Zimbra\Admin\Struct\SessionForWaitSet;
use Zimbra\Admin\Struct\WaitSetInfo;
use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Common\Struct\IdAndType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WaitSetInfo.
 */
class WaitSetInfoTest extends ZimbraTestCase
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

        $waitSet = new StubWaitSetInfo(
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

        $waitSet = new StubWaitSetInfo();
        $waitSet->setWaitSetId($waitSetId)
            ->setOwner($owner)
            ->setDefaultInterests($defaultInterests)
            ->setLastAccessDate($lastAccessDate)
            ->setErrors([$error])
            ->setSignalledAccounts($signalledAccounts)
            ->setCbSeqNo($cbSeqNo)
            ->setCurrentSeqNo($currentSeqNo)
            ->setNextSeqNo($nextSeqNo)
            ->setBufferedCommits([$commit])
            ->setSessions([$session]);
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$waitSetId" owner="$owner" defTypes="$defaultInterests" ld="$lastAccessDate" cbSeqNo="$cbSeqNo" currentSeqNo="$currentSeqNo" nextSeqNo="$nextSeqNo" xmlns:urn="urn:zimbraAdmin">
    <urn:errors>
        <urn:error id="$id" type="$type" />
    </urn:errors>
    <urn:ready accounts="$accounts" />
    <urn:buffered>
        <urn:commit aid="$aid" cid="$cid" />
    </urn:buffered>
    <urn:session account="$account" types="$interests" token="$token" mboxSyncToken="$mboxSyncToken" mboxSyncTokenDiff="$mboxSyncTokenDiff" acctIdError="$acctIdError">
        <urn:WaitSetSession interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
    </urn:session>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($waitSet, 'xml'));
        $this->assertEquals($waitSet, $this->serializer->deserialize($xml, StubWaitSetInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubWaitSetInfo extends WaitSetInfo
{
}
