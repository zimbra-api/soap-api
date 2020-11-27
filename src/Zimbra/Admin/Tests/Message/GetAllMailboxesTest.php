<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllMailboxesBody;
use Zimbra\Admin\Message\GetAllMailboxesEnvelope;
use Zimbra\Admin\Message\GetAllMailboxesRequest;
use Zimbra\Admin\Message\GetAllMailboxesResponse;
use Zimbra\Admin\Struct\MailboxInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllMailboxesTest.
 */
class GetAllMailboxesTest extends ZimbraStructTestCase
{
    public function testGetAllMailboxes()
    {
        $id = mt_rand(1, 100);
        $groupId = mt_rand(1, 100);
        $accountId = $this->faker->uuid;
        $indexVolumeId = mt_rand(1, 100);
        $itemIdCheckPoint = mt_rand(1, 100);
        $contactCount = mt_rand(1, 100);
        $sizeCheckPoint = mt_rand(1, 100);
        $changeCheckPoint = mt_rand(1, 100);
        $trackingSync = mt_rand(1, 100);
        $lastBackupAt = mt_rand(1, 100);
        $lastSoapAccess = mt_rand(1, 100);
        $newMessages = mt_rand(1, 100);
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $searchTotal = mt_rand(1, 100);

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

        $response = new GetAllMailboxesResponse(FALSE, 0);
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllMailboxesRequest limit="' . $limit . '" offset="' . $offset . '" />'
                    . '<urn:GetAllMailboxesResponse more="true" searchTotal="' . $searchTotal . '">'
                        . '<mbox id="' . $id . '" groupId="' . $groupId . '" accountId="' . $accountId . '" indexVolumeId="' . $indexVolumeId . '" itemIdCheckPoint="' . $itemIdCheckPoint . '" contactCount="' . $contactCount . '" sizeCheckPoint="' . $sizeCheckPoint . '" changeCheckPoint="' . $changeCheckPoint . '" trackingSync="' . $trackingSync . '" trackingImap="true" lastBackupAt="' . $lastBackupAt . '" lastSoapAccess="' . $lastSoapAccess . '" newMessages="' . $newMessages . '" />'
                    . '</urn:GetAllMailboxesResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllMailboxesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllMailboxesRequest' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllMailboxesResponse' => [
                    'more' => TRUE,
                    'searchTotal' => $searchTotal,
                    'mbox' => [
                        [
                            'id' => $id,
                            'groupId' => $groupId,
                            'accountId' => $accountId,
                            'indexVolumeId' => $indexVolumeId,
                            'itemIdCheckPoint' => $itemIdCheckPoint,
                            'contactCount' => $contactCount,
                            'sizeCheckPoint' => $sizeCheckPoint,
                            'changeCheckPoint' => $changeCheckPoint,
                            'trackingSync' => $trackingSync,
                            'trackingImap' => TRUE,
                            'lastBackupAt' => $lastBackupAt,
                            'lastSoapAccess' => $lastSoapAccess,
                            'newMessages' => $newMessages,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllMailboxesEnvelope::class, 'json'));
    }
}
