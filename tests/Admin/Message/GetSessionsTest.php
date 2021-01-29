<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetSessionsBody;
use Zimbra\Admin\Message\GetSessionsEnvelope;
use Zimbra\Admin\Message\GetSessionsRequest;
use Zimbra\Admin\Message\GetSessionsResponse;

use Zimbra\Admin\Struct\SimpleSessionInfo;
use Zimbra\Enum\GetSessionsSortBy;
use Zimbra\Enum\SessionType;

use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GetSessionsTest.
 */
class GetSessionsTest extends ZimbraStructTestCase
{
    public function testGetSessions()
    {
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $total = mt_rand(1, 100);

        $request = new GetSessionsRequest(SessionType::IMAP(), GetSessionsSortBy::NAME_DESC(), $offset, $limit, FALSE);
        $this->assertEquals(SessionType::IMAP(), $request->getType());
        $this->assertEquals(GetSessionsSortBy::NAME_DESC(), $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertFalse($request->getRefresh());

        $request = new GetSessionsRequest(SessionType::IMAP());
        $request->setType(SessionType::SOAP())
            ->setSortBy(GetSessionsSortBy::NAME_ASC())
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(TRUE);
        $this->assertEquals(SessionType::SOAP(), $request->getType());
        $this->assertEquals(GetSessionsSortBy::NAME_ASC(), $request->getSortBy());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertTrue($request->getRefresh());

        $session = new SimpleSessionInfo(
            $zimbraId, $name, $sessionId, $createdDate, $lastAccessedDate
        );

        $response = new GetSessionsResponse(FALSE, $total, [$session]);
        $this->assertFalse($response->getMore());
        $this->assertSame($total, $response->getTotal());
        $this->assertSame([$session], $response->getSessions());
        $response = new GetSessionsResponse(FALSE, 0);
        $response->setMore(TRUE)
            ->setTotal($total)
            ->setSessions([$session])
            ->addSession($session);
        $this->assertTrue($response->getMore());
        $this->assertSame($total, $response->getTotal());
        $this->assertSame([$session, $session], $response->getSessions());
        $response->setSessions([$session]);

        $body = new GetSessionsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetSessionsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetSessionsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetSessionsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetSessionsRequest type="soap" sortBy="nameAsc" offset="$offset" limit="$limit" refresh="true" />
        <urn:GetSessionsResponse more="true" total="$total">
            <s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
        </urn:GetSessionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSessionsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetSessionsRequest' => [
                    'type' => 'soap',
                    'sortBy' => 'nameAsc',
                    'offset' => $offset,
                    'limit' => $limit,
                    'refresh' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetSessionsResponse' => [
                    'more' => TRUE,
                    'total' => $total,
                    's' => [
                        [
                            'zid' => $zimbraId,
                            'name' => $name,
                            'sid' => $sessionId,
                            'cd' => $createdDate,
                            'ld' => $lastAccessedDate,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetSessionsEnvelope::class, 'json'));
    }
}
