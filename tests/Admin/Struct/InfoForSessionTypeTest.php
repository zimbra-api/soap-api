<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountSessionInfo;
use Zimbra\Admin\Struct\InfoForSessionType;
use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for InfoForSessionType.
 */
class InfoForSessionTypeTest extends ZimbraStructTestCase
{
    public function testInfoForSessionType()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $activeAccounts = mt_rand(1, 1000);
        $activeSessions = mt_rand(1, 1000);

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );

        $account = new AccountSessionInfo($name, $id, [$session]);

        $infoSession = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $this->assertSame($activeSessions, $infoSession->getActiveSessions());
        $this->assertSame($activeAccounts, $infoSession->getActiveAccounts());
        $this->assertSame([$account], $infoSession->getAccounts());
        $this->assertSame([$session], $infoSession->getSessions());
        $infoSession = new InfoForSessionType(0, 0);
        $infoSession->setActiveSessions($activeSessions)
            ->setActiveAccounts($activeAccounts)
            ->setAccounts([$account])
            ->addAccount($account)
            ->setSessions([$session])
            ->addSession($session);
        $this->assertSame($activeSessions, $infoSession->getActiveSessions());
        $this->assertSame($activeAccounts, $infoSession->getActiveAccounts());
        $this->assertSame([$account, $account], $infoSession->getAccounts());
        $this->assertSame([$session, $session], $infoSession->getSessions());

        $infoSession = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $xml = <<<EOT
<?xml version="1.0"?>
<infoSession activeAccounts="$activeAccounts" activeSessions="$activeSessions">
    <zid name="$name" id="$id">
        <s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
    </zid>
    <s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
</infoSession>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($infoSession, 'xml'));
        $this->assertEquals($infoSession, $this->serializer->deserialize($xml, InfoForSessionType::class, 'xml'));

        $json = json_encode([
            'activeAccounts' => $activeAccounts,
            'activeSessions' => $activeSessions,
            'zid' => [
                [
                    'name' => $name,
                    'id' => $id,
                    's' => [
                        [
                            'zid' => $zimbraId,
                            'name' => $name,
                            'sid' => $sessionId,
                            'cd' => $createdDate,
                            'ld' => $lastAccessedDate,
                        ],
                    ],
                ],
            ],
            's' => [
                [
                    'zid' => $zimbraId,
                    'name' => $name,
                    'sid' => $sessionId,
                    'cd' => $createdDate,
                    'ld' => $lastAccessedDate,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($infoSession, 'json'));
        $this->assertEquals($infoSession, $this->serializer->deserialize($json, InfoForSessionType::class, 'json'));
    }
}
