<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\SearchVoice;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Enum\VoiceSortBy;

/**
 * Testcase class for SearchVoice.
 */
class SearchVoiceTest extends ZimbraVoiceApiTestCase
{
    public function testSearchVoiceRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $req = new SearchVoice(
            $query, $storeprincipal, $limit, $offset, $types, VoiceSortBy::DATE_DESC()
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($types, $req->getTypes());
        $this->assertTrue($req->getSortBy()->is('dateDesc'));

        $req->setQuery($query)
            ->setStorePrincipal($storeprincipal)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setTypes($types)
            ->setSortBy(VoiceSortBy::DATE_DESC());
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($types, $req->getTypes());
        $this->assertTrue($req->getSortBy()->is('dateDesc'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchVoiceRequest query="' . $query . '" limit="' . $limit . '" offset="' . $offset . '" types="' . $types . '" sortBy="' . VoiceSortBy::DATE_DESC() . '">'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
            .'</SearchVoiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchVoiceRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'query' => $query,
                'limit' => $limit,
                'offset' => $offset,
                'types' => $types,
                'sortBy' => VoiceSortBy::DATE_DESC()->value(),
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchVoiceApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $this->api->searchVoice(
            $query, $storeprincipal, $limit, $offset, $types, VoiceSortBy::DATE_DESC()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:SearchVoiceRequest query="' . $query . '" limit="' . $limit . '" offset="' . $offset . '" types="' . $types . '" sortBy="' . VoiceSortBy::DATE_DESC() . '">'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                    .'</urn1:SearchVoiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
