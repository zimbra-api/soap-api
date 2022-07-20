<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllMailboxesBody;
use Zimbra\Admin\Message\GetAllMailboxesEnvelope;
use Zimbra\Admin\Message\GetAllMailboxesRequest;
use Zimbra\Admin\Message\GetAllMailboxesResponse;
use Zimbra\Admin\Struct\MailboxInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllMailboxesTest.
 */
class GetAllMailboxesTest extends ZimbraTestCase
{
    public function testGetAllMailboxes()
    {
        $id = $this->faker->randomNumber;
        $groupId = $this->faker->randomNumber;
        $accountId = $this->faker->uuid;
        $indexVolumeId = $this->faker->randomNumber;
        $itemIdCheckPoint = $this->faker->randomNumber;
        $contactCount = $this->faker->randomNumber;
        $sizeCheckPoint = $this->faker->randomNumber;
        $changeCheckPoint = $this->faker->randomNumber;
        $trackingSync = $this->faker->randomNumber;
        $lastBackupAt = $this->faker->randomNumber;
        $lastSoapAccess = $this->faker->randomNumber;
        $newMessages = $this->faker->randomNumber;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $searchTotal = $this->faker->randomNumber;

        $mbox = new MailboxInfo(
            $id, $groupId, $accountId, $indexVolumeId, $itemIdCheckPoint,
            $contactCount, $sizeCheckPoint, $changeCheckPoint, $trackingSync, TRUE,
            $lastBackupAt, $lastSoapAccess, $newMessages
        );

        $request = new GetAllMailboxesRequest($limit, $offset);
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $request = new GetAllMailboxesRequest();
        $request->setLimit($limit)
             ->setOffset($offset);
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $response = new GetAllMailboxesResponse(FALSE, $searchTotal, [$mbox]);
        $this->assertFalse($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$mbox], $response->getMboxes());

        $response = new GetAllMailboxesResponse();
        $response->setMore(TRUE)
            ->setSearchTotal($searchTotal)
            ->setMboxes([$mbox])
            ->addMbox($mbox);
        $this->assertTrue($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$mbox, $mbox], $response->getMboxes());
        $response->setMboxes([$mbox]);

        $body = new GetAllMailboxesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllMailboxesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllMailboxesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllMailboxesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllMailboxesRequest limit="$limit" offset="$offset" />
        <urn:GetAllMailboxesResponse more="true" searchTotal="$searchTotal">
            <urn:mbox id="$id" groupId="$groupId" accountId="$accountId" indexVolumeId="$indexVolumeId" itemIdCheckPoint="$itemIdCheckPoint" contactCount="$contactCount" sizeCheckPoint="$sizeCheckPoint" changeCheckPoint="$changeCheckPoint" trackingSync="$trackingSync" trackingImap="true" lastBackupAt="$lastBackupAt" lastSoapAccess="$lastSoapAccess" newMessages="$newMessages" />
        </urn:GetAllMailboxesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllMailboxesEnvelope::class, 'xml'));
    }
}
