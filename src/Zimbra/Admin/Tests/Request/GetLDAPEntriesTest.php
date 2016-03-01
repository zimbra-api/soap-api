<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetLDAPEntries;

/**
 * Testcase class for GetLDAPEntries.
 */
class GetLDAPEntriesTest extends ZimbraAdminApiTestCase
{
    public function testGetLDAPEntriesRequest()
    {
        $query = $this->faker->word;
        $searchBase = $this->faker->word;
        $sortBy = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new GetLDAPEntries(
            $query, $searchBase, $sortBy, false, $limit, $offset
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($searchBase, $req->getLdapSearchBase());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setQuery($query)
            ->setLdapSearchBase($searchBase)
            ->setSortBy($sortBy)
            ->setSortAscending(true)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($searchBase, $req->getLdapSearchBase());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetLDAPEntriesRequest query="' . $query . '" sortBy="' . $sortBy . '" sortAscending="true" limit="' . $limit . '" offset="' . $offset . '">'
                . '<ldapSearchBase>' . $searchBase . '</ldapSearchBase>'
            . '</GetLDAPEntriesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetLDAPEntriesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'ldapSearchBase' => $searchBase,
                'sortBy' => $sortBy,
                'sortAscending' => true,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLDAPEntriesApi()
    {
        $query = $this->faker->word;
        $searchBase = $this->faker->word;
        $sortBy = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->api->getLDAPEntries(
            $query, $searchBase, $sortBy, true, $limit, $offset
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetLDAPEntriesRequest query="' . $query . '" sortBy="' . $sortBy . '" sortAscending="true" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:ldapSearchBase>' . $searchBase . '</urn1:ldapSearchBase>'
                    . '</urn1:GetLDAPEntriesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
