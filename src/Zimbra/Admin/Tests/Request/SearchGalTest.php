<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SearchGal;
use Zimbra\Enum\GalSearchType;

/**
 * Testcase class for SearchGal.
 */
class SearchGalTest extends ZimbraAdminApiTestCase
{
    public function testSearchGalRequest()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->word;
        $limit = mt_rand(0, 100);

        $req = new SearchGal(
            $domain, $name, $limit, GalSearchType::ALL(), $galAcctId
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals('all', $req->getType()->value());
        $this->assertEquals($galAcctId, $req->getGalAccounttId());

        $req->setDomain($domain)
            ->setName($name)
            ->setLimit($limit)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccounttId($galAcctId);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals('account', $req->getType()->value());
        $this->assertEquals($galAcctId, $req->getGalAccounttId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchGalRequest '
                . 'domain="' . $domain . '" '
                . 'name="' . $name . '" '
                . 'limit="' . $limit . '" '
                . 'type="' . GalSearchType::ACCOUNT() . '" '
                . 'galAcctId="' . $galAcctId . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchGalRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'name' => $name,
                'limit' => $limit,
                'type' => GalSearchType::ACCOUNT()->value(),
                'galAcctId' => $galAcctId,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchGalApi()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->word;
        $limit = mt_rand(0, 100);
        $this->api->searchGal(
            $domain, $name, $limit, GalSearchType::ACCOUNT(), $galAcctId
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest '
                        . 'domain="' . $domain . '" '
                        . 'name="' . $name . '" '
                        . 'limit="' . $limit . '" '
                        . 'type="' . GalSearchType::ACCOUNT() . '" '
                        . 'galAcctId="' . $galAcctId . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
