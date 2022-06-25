<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\WaitSetSessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WaitSetSessionInfo.
 */
class WaitSetSessionInfoTest extends ZimbraTestCase
{
    public function testWaitSetSessionInfo()
    {
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
        $this->assertSame($interestMask, $WaitSetSession->getInterestMask());
        $this->assertSame($highestChangeId, $WaitSetSession->getHighestChangeId());
        $this->assertSame($lastAccessTime, $WaitSetSession->getLastAccessTime());
        $this->assertSame($creationTime, $WaitSetSession->getCreationTime());
        $this->assertSame($sessionId, $WaitSetSession->getSessionId());
        $this->assertSame($token, $WaitSetSession->getToken());
        $this->assertSame($folderInterests, $WaitSetSession->getFolderInterests());
        $this->assertSame($changedFolders, $WaitSetSession->getChangedFolders());

        $WaitSetSession = new WaitSetSessionInfo('', 0, 0, 0, '');
        $WaitSetSession->setInterestMask($interestMask)
            ->setHighestChangeId($highestChangeId)
            ->setLastAccessTime($lastAccessTime)
            ->setCreationTime($creationTime)
            ->setSessionId($sessionId)
            ->setToken($token)
            ->setFolderInterests($folderInterests)
            ->setChangedFolders($changedFolders);
        $this->assertSame($interestMask, $WaitSetSession->getInterestMask());
        $this->assertSame($highestChangeId, $WaitSetSession->getHighestChangeId());
        $this->assertSame($lastAccessTime, $WaitSetSession->getLastAccessTime());
        $this->assertSame($creationTime, $WaitSetSession->getCreationTime());
        $this->assertSame($sessionId, $WaitSetSession->getSessionId());
        $this->assertSame($token, $WaitSetSession->getToken());
        $this->assertSame($folderInterests, $WaitSetSession->getFolderInterests());
        $this->assertSame($changedFolders, $WaitSetSession->getChangedFolders());

        $xml = <<<EOT
<?xml version="1.0"?>
<result interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($WaitSetSession, 'xml'));
        $this->assertEquals($WaitSetSession, $this->serializer->deserialize($xml, WaitSetSessionInfo::class, 'xml'));
    }
}
