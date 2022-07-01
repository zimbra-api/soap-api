<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DumpSessionsBody;
use Zimbra\Admin\Message\DumpSessionsEnvelope;
use Zimbra\Admin\Message\DumpSessionsRequest;
use Zimbra\Admin\Message\DumpSessionsResponse;
use Zimbra\Admin\Struct\AccountSessionInfo;
use Zimbra\Admin\Struct\InfoForSessionType;
use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DumpSessions.
 */
class DumpSessionsTest extends ZimbraTestCase
{
    public function testDumpSessions()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $activeAccounts = mt_rand(1, 1000);
        $activeSessions = mt_rand(1, 1000);
        $totalActiveSessions = mt_rand(1, 1000);

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );
        $account = new AccountSessionInfo($name, $id, [$session]);
        $soap = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $imap = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $admin = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $wiki = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $synclistener = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);
        $waitset = new InfoForSessionType($activeSessions, $activeAccounts, [$account], [$session]);

        $request = new DumpSessionsRequest(FALSE, FALSE);
        $this->assertFalse($request->getIncludeAccounts());
        $this->assertFalse($request->getGroupByAccount());
        $request->setIncludeAccounts(TRUE)
            ->setGroupByAccount(TRUE);
        $this->assertTrue($request->getIncludeAccounts());
        $this->assertTrue($request->getGroupByAccount());

        $response = new DumpSessionsResponse($totalActiveSessions, $soap, $imap, $admin, $wiki, $synclistener, $waitset);
        $this->assertSame($totalActiveSessions, $response->getTotalActiveSessions());
        $this->assertSame($soap, $response->getSoapSessions());
        $this->assertSame($imap, $response->getImapSessions());
        $this->assertSame($admin, $response->getAdminSessions());
        $this->assertSame($wiki, $response->getWikiSessions());
        $this->assertSame($synclistener, $response->getSynclistenerSessions());
        $this->assertSame($waitset, $response->getWaitsetSessions());
        $response = new DumpSessionsResponse(0);
        $response->setTotalActiveSessions($totalActiveSessions)
            ->setSoapSessions($soap)
            ->setImapSessions($imap)
            ->setAdminSessions($admin)
            ->setWikiSessions($wiki)
            ->setSynclistenerSessions($synclistener)
            ->setWaitsetSessions($waitset);
        $this->assertSame($totalActiveSessions, $response->getTotalActiveSessions());
        $this->assertSame($soap, $response->getSoapSessions());
        $this->assertSame($imap, $response->getImapSessions());
        $this->assertSame($admin, $response->getAdminSessions());
        $this->assertSame($wiki, $response->getWikiSessions());
        $this->assertSame($synclistener, $response->getSynclistenerSessions());
        $this->assertSame($waitset, $response->getWaitsetSessions());

        $body = new DumpSessionsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DumpSessionsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DumpSessionsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DumpSessionsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DumpSessionsRequest listSessions="true" groupByAccount="true" />
        <urn:DumpSessionsResponse activeSessions="$totalActiveSessions">
            <urn:soap activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:soap>
            <urn:imap activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:imap>
            <urn:admin activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:admin>
            <urn:wiki activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:wiki>
            <urn:synclistener activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:synclistener>
            <urn:waitset activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:waitset>
        </urn:DumpSessionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DumpSessionsEnvelope::class, 'xml'));
    }
}
