<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetQuotaUsageBody;
use Zimbra\Admin\Message\GetQuotaUsageEnvelope;
use Zimbra\Admin\Message\GetQuotaUsageRequest;
use Zimbra\Admin\Message\GetQuotaUsageResponse;
use Zimbra\Admin\Struct\AccountQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetQuotaUsageTest.
 */
class GetQuotaUsageTest extends ZimbraTestCase
{
    public function testGetQuotaUsage()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domain = $this->faker->word;
        $sortBy = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $quotaUsed = mt_rand(1, 100);
        $quotaLimit = mt_rand(1, 100);
        $searchTotal = mt_rand(1, 100);

        $request = new GetQuotaUsageRequest($domain, FALSE, $limit, $offset, $sortBy, FALSE, FALSE);
        $this->assertSame($domain, $request->getDomain());
        $this->assertFalse($request->isAllServers());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertFalse($request->isSortAscending());
        $this->assertFalse($request->isRefresh());

        $request = new GetQuotaUsageRequest();
        $request->setDomain($domain)
            ->setAllServers(TRUE)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortBy($sortBy)
            ->setSortAscending(TRUE)
            ->setRefresh(TRUE);
        $this->assertSame($domain, $request->getDomain());
        $this->assertTrue($request->isAllServers());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertSame($sortBy, $request->getSortBy());
        $this->assertTrue($request->isSortAscending());
        $this->assertTrue($request->isRefresh());

        $account = new AccountQuotaInfo(
            $name, $id, $quotaUsed, $quotaLimit
        );

        $response = new GetQuotaUsageResponse(FALSE, $searchTotal, [$account]);
        $this->assertFalse($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$account], $response->getAccountQuotas());
        $response = new GetQuotaUsageResponse(FALSE, 0);
        $response->setMore(TRUE)
            ->setSearchTotal($searchTotal)
            ->setAccountQuotas([$account])
            ->addAccountQuota($account);
        $this->assertTrue($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertSame([$account, $account], $response->getAccountQuotas());
        $response->setAccountQuotas([$account]);

        $body = new GetQuotaUsageBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetQuotaUsageBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetQuotaUsageEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetQuotaUsageEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetQuotaUsageRequest domain="$domain" allServers="true" limit="$limit" offset="$offset" sortBy="$sortBy" sortAscending="true" refresh="true" />
        <urn:GetQuotaUsageResponse more="true" searchTotal="$searchTotal">
            <account name="$name" id="$id" used="$quotaUsed" limit="$quotaLimit" />
        </urn:GetQuotaUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetQuotaUsageEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetQuotaUsageRequest' => [
                    'domain' => $domain,
                    'allServers' => TRUE,
                    'limit' => $limit,
                    'offset' => $offset,
                    'sortBy' => $sortBy,
                    'sortAscending' => TRUE,
                    'refresh' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetQuotaUsageResponse' => [
                    'more' => TRUE,
                    'searchTotal' => $searchTotal,
                    'account' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'used' => $quotaUsed,
                            'limit' => $quotaLimit,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetQuotaUsageEnvelope::class, 'json'));
    }
}
