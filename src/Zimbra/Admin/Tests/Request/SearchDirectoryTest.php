<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SearchDirectory;
use Zimbra\Enum\DirectorySearchType as DirSearchType;

/**
 * Testcase class for SearchDirectory.
 */
class SearchDirectoryTest extends ZimbraAdminApiTestCase
{
    public function testSearchDirectoryRequest()
    {
        $query = $this->faker->word;
        $domain = $this->faker->word;
        $sortBy = $this->faker->word;
        $attrs = $this->faker->word;
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new  SearchDirectory(
            $query, $maxResults, $limit, $offset, $domain, false, true, [DirSearchType::RESOURCES()], $sortBy, true, false, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertTrue($req->getApplyConfig());
        $this->assertEquals('resources', $req->getTypes());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());
        $this->assertFalse($req->getCountOnly());

        $req->setQuery($query)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setApplyConfig(false)
            ->addType(DirSearchType::ACCOUNTS())
            ->setSortBy($sortBy)
            ->setSortAscending(false)
            ->setCountOnly(true);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertFalse($req->getApplyConfig());
        $this->assertEquals('resources,accounts', $req->getTypes());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());
        $this->assertTrue($req->getCountOnly());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchDirectoryRequest '
                . 'query="' . $query . '" '
                . 'maxResults="' . $maxResults . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'applyConfig="false" '
                . 'types="resources,accounts" '
                . 'sortBy="' . $sortBy . '" '
                . 'sortAscending="false" '
                . 'countOnly="true" '
                . 'attrs="' . $attrs . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'maxResults' => $maxResults,
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'applyConfig' => false,
                'types' => 'resources,accounts',
                'sortBy' => $sortBy,
                'sortAscending' => false,
                'countOnly' => true,
                'attrs' => $attrs,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchDirectoryApi()
    {
        $query = $this->faker->word;
        $domain = $this->faker->word;
        $sortBy = $this->faker->word;
        $attrs = $this->faker->word;
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $this->api->searchDirectory(
            $query, $maxResults, $limit, $offset, $domain, true, false, [DirSearchType::ACCOUNTS()], $sortBy, false, true, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchDirectoryRequest '
                        . 'query="' . $query . '" '
                        . 'maxResults="' . $maxResults . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'applyConfig="false" '
                        . 'types="' . DirSearchType::ACCOUNTS() . '" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'countOnly="true" '
                        . 'attrs="' . $attrs . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
