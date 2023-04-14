<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\SessionForWaitSet;
use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SessionForWaitSet.
 */
class SessionForWaitSetTest extends ZimbraTestCase
{
    public function testSessionForWaitSet()
    {
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

        $WaitSetSession = new WaitSetSessionInfo(
            $interestMask, $highestChangeId, $lastAccessTime, $creationTime, $sessionId, $token, $folderInterests, $changedFolders
        );

        $session = new StubSessionForWaitSet(
            $account, $interests, $token, $mboxSyncToken, $mboxSyncTokenDiff, $acctIdError, $WaitSetSession
        );
        $this->assertSame($account, $session->getAccount());
        $this->assertSame($interests, $session->getInterests());
        $this->assertSame($token, $session->getToken());
        $this->assertSame($mboxSyncToken, $session->getMboxSyncToken());
        $this->assertSame($mboxSyncTokenDiff, $session->getMboxSyncTokenDiff());
        $this->assertSame($acctIdError, $session->getAcctIdError());
        $this->assertSame($WaitSetSession, $session->getWaitSetSession());

        $session = new StubSessionForWaitSet();
        $session->setAccount($account)
            ->setInterests($interests)
            ->setToken($token)
            ->setMboxSyncToken($mboxSyncToken)
            ->setMboxSyncTokenDiff($mboxSyncTokenDiff)
            ->setAcctIdError($acctIdError)
            ->setWaitSetSession($WaitSetSession);
        $this->assertSame($account, $session->getAccount());
        $this->assertSame($interests, $session->getInterests());
        $this->assertSame($token, $session->getToken());
        $this->assertSame($mboxSyncToken, $session->getMboxSyncToken());
        $this->assertSame($mboxSyncTokenDiff, $session->getMboxSyncTokenDiff());
        $this->assertSame($acctIdError, $session->getAcctIdError());
        $this->assertSame($WaitSetSession, $session->getWaitSetSession());

        $xml = <<<EOT
<?xml version="1.0"?>
<result account="$account" types="$interests" token="$token" mboxSyncToken="$mboxSyncToken" mboxSyncTokenDiff="$mboxSyncTokenDiff" acctIdError="$acctIdError" xmlns:urn="urn:zimbraAdmin">
    <urn:WaitSetSession interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($xml, StubSessionForWaitSet::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubSessionForWaitSet extends SessionForWaitSet
{
}
