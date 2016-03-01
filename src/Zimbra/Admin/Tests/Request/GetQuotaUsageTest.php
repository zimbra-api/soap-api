<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetQuotaUsage;
use Zimbra\Enum\QuotaSortBy;

/**
 * Testcase class for GetQuotaUsage.
 */
class GetQuotaUsageTest extends ZimbraAdminApiTestCase
{
    public function testGetQuotaUsageRequest()
    {
        $domain = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new GetQuotaUsage(
            $domain, false, $limit, $offset, QuotaSortBy::PERCENT_USED(), false, true
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getAllServers());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame('percentUsed', $req->getSortBy()->value());
        $this->assertFalse($req->getSortAscending());
        $this->assertTrue($req->getRefresh());

        $req->setDomain($domain)
            ->setAllServers(true)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortBy(QuotaSortBy::TOTAL_USED())
            ->setSortAscending(true)
            ->setRefresh(false);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getAllServers());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame('totalUsed', $req->getSortBy()->value());
        $this->assertTrue($req->getSortAscending());
        $this->assertFalse($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetQuotaUsageRequest '
                . 'domain="' . $domain . '" '
                . 'allServers="true" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'sortBy="' . QuotaSortBy::TOTAL_USED() . '" '
                . 'sortAscending="true" '
                . 'refresh="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetQuotaUsageRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'allServers' => true,
                'limit' => $limit,
                'offset' => $offset,
                'sortBy' => QuotaSortBy::TOTAL_USED()->value(),
                'sortAscending' => true,
                'refresh' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetQuotaUsageApi()
    {
        $domain = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->api->getQuotaUsage(
            $domain, true, $limit, $offset, QuotaSortBy::TOTAL_USED(), true, false
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetQuotaUsageRequest '
                        . 'domain="' . $domain . '" '
                        . 'allServers="true" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'sortBy="' . QuotaSortBy::TOTAL_USED() . '" '
                        . 'sortAscending="true" '
                        . 'refresh="false" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
