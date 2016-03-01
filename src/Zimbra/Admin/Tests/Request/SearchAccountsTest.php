<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SearchAccounts;

/**
 * Testcase class for SearchAccounts.
 */
class SearchAccountsTest extends ZimbraAdminApiTestCase
{
    public function testSearchAccountsRequest()
    {
        $query = $this->faker->word;
        $domain = $this->faker->word;
        $attrs = 'displayName,zimbraId,zimbraAccountStatus';
        $sortBy = $this->faker->word;
        $types = 'accounts,resources';
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\SearchAccounts(
            $query, $limit, $offset, $domain, false, $attrs, $sortBy, $types, true 
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertEquals($attrs, $req->getAttrs());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertEquals($types, $req->getTypes());
        $this->assertTrue($req->getSortAscending());

        $req->setQuery($query)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setAttrs($attrs)
            ->setSortBy($sortBy)
            ->setTypes($types)
            ->setSortAscending(false);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertEquals($attrs, $req->getAttrs());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertEquals($types, $req->getTypes());
        $this->assertFalse($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchAccountsRequest '
                . 'query="' . $query . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'attrs="' . $attrs . '" '
                . 'sortBy="' . $sortBy . '" '
                . 'types="' . $types . '" '
                . 'sortAscending="false" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchAccountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'attrs' => $attrs,
                'sortBy' => $sortBy,
                'types' => $types,
                'sortAscending' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchAccountsApi()
    {
        $query = $this->faker->word;
        $domain = $this->faker->word;
        $attrs = 'displayName,zimbraId,zimbraAccountStatus';
        $sortBy = $this->faker->word;
        $types = 'accounts,resources';
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->api->searchAccounts(
            $query, $limit, $offset, $domain, true, $attrs, $sortBy, $types, false 
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchAccountsRequest '
                        . 'query="' . $query . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'attrs="' . $attrs . '" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'types="' . $types . '" '
                        . 'sortAscending="false" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
