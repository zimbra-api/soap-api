<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AccountSessionInfo;
use Zimbra\Admin\Struct\InfoForSessionType;
use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InfoForSessionType.
 */
class InfoForSessionTypeTest extends ZimbraTestCase
{
    public function testInfoForSessionType()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = $this->faker->unixTime;
        $lastAccessedDate = $this->faker->unixTime;
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $activeAccounts = $this->faker->randomNumber;
        $activeSessions = $this->faker->randomNumber;

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );

        $account = new AccountSessionInfo($name, $id, [$session]);

        $infoSession = new StubInfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $this->assertSame($activeSessions, $infoSession->getActiveSessions());
        $this->assertSame($activeAccounts, $infoSession->getActiveAccounts());
        $this->assertSame([$account], $infoSession->getAccounts());
        $this->assertSame([$session], $infoSession->getSessions());
        $infoSession = new StubInfoForSessionType();
        $infoSession->setActiveSessions($activeSessions)
            ->setActiveAccounts($activeAccounts)
            ->setAccounts([$account])
            ->setSessions([$session]);
        $this->assertSame($activeSessions, $infoSession->getActiveSessions());
        $this->assertSame($activeAccounts, $infoSession->getActiveAccounts());
        $this->assertSame([$account], $infoSession->getAccounts());
        $this->assertSame([$session], $infoSession->getSessions());

        $infoSession = new StubInfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $xml = <<<EOT
<?xml version="1.0"?>
<result activeAccounts="$activeAccounts" activeSessions="$activeSessions" xmlns:urn="urn:zimbraAdmin">
    <urn:zid name="$name" id="$id">
        <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
    </urn:zid>
    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($infoSession, 'xml'));
        $this->assertEquals($infoSession, $this->serializer->deserialize($xml, StubInfoForSessionType::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubInfoForSessionType extends InfoForSessionType
{
}
