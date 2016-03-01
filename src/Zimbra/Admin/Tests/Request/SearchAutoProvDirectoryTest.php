<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SearchAutoProvDirectory;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for SearchAutoProvDirectory.
 */
class SearchAutoProvDirectoryTest extends ZimbraAdminApiTestCase
{
    public function testSearchAutoProvDirectoryRequest()
    {
        $value = $this->faker->word;
        $keyAttr = $this->faker->word;
        $query = $this->faker->word;
        $name = $this->faker->word;
        $attrs = $this->faker->word;
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $req = new SearchAutoProvDirectory(
            $domain, $keyAttr, $query, $name, $maxResults, $limit, $offset, false, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($keyAttr, $req->getKeyAttr());
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertFalse($req->getRefresh());

        $req->setDomain($domain)
            ->setKeyAttr($keyAttr)
            ->setQuery($query)
            ->setName($name)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(true);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($keyAttr, $req->getKeyAttr());
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertTrue($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchAutoProvDirectoryRequest '
                . 'keyAttr="' . $keyAttr . '" '
                . 'query="' . $query . '" '
                . 'name="' . $name . '" '
                . 'maxResults="' . $maxResults . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'refresh="true" '
                . 'attrs="' . $attrs . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</SearchAutoProvDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchAutoProvDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'keyAttr' => $keyAttr,
                'query' => $query,
                'name' => $name,
                'maxResults' => $maxResults,
                'limit' => $limit,
                'offset' => $offset,
                'refresh' => true,
                'attrs' => $attrs,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchAutoProvDirectoryApi()
    {
        $value = $this->faker->word;
        $keyAttr = $this->faker->word;
        $query = $this->faker->word;
        $name = $this->faker->word;
        $attrs = $this->faker->word;
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->searchAutoProvDirectory(
            $domain, $keyAttr, $query, $name, $maxResults, $limit, $offset, true, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchAutoProvDirectoryRequest keyAttr="' . $keyAttr . '" query="' . $query . '" name="' . $name . '" maxResults="' . $maxResults . '" limit="' . $limit . '" offset="' . $offset . '" refresh="true" attrs="' . $attrs . '">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:SearchAutoProvDirectoryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
