<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SessionForWaitSet;
use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SessionForWaitSet.
 */
class SessionForWaitSetTest extends ZimbraStructTestCase
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

        $session = new SessionForWaitSet(
            $account, $interests, $token, $mboxSyncToken, $mboxSyncTokenDiff, $acctIdError, $WaitSetSession
        );
        $this->assertSame($account, $session->getAccount());
        $this->assertSame($interests, $session->getInterests());
        $this->assertSame($token, $session->getToken());
        $this->assertSame($mboxSyncToken, $session->getMboxSyncToken());
        $this->assertSame($mboxSyncTokenDiff, $session->getMboxSyncTokenDiff());
        $this->assertSame($acctIdError, $session->getAcctIdError());
        $this->assertSame($WaitSetSession, $session->getWaitSetSession());

        $session = new SessionForWaitSet('', '');
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
<session account="$account" types="$interests" token="$token" mboxSyncToken="$mboxSyncToken" mboxSyncTokenDiff="$mboxSyncTokenDiff" acctIdError="$acctIdError">
    <WaitSetSession interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
</session>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($xml, SessionForWaitSet::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($session, 'json'));
        $this->assertEquals($session, $this->serializer->deserialize($json, SessionForWaitSet::class, 'json'));
    }
}
