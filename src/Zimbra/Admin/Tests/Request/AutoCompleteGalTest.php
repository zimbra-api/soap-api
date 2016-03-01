<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AutoCompleteGal;
use Zimbra\Enum\GalSearchType;

/**
 * Testcase class for AutoCompleteGal.
 */
class AutoCompleteGalTest extends ZimbraAdminApiTestCase
{
    public function testAutoCompleteGalRequest()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->uuid;
        $limit = mt_rand(0, 100);

        $req = new AutoCompleteGal(
            $domain, $name, GalSearchType::ALL(), $galAcctId, $limit
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req->setDomain($domain)
            ->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccountId($galAcctId)
            ->setLimit($limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAcctId . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoCompleteGalRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'name' => $name,
                'type' => GalSearchType::ACCOUNT()->value(),
                'galAcctId' => $galAcctId,
                'limit' => $limit,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGalApi()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAcctId = $this->faker->word;
        $limit = mt_rand(0, 100);
        $this->api->autoCompleteGal(
            $domain, $name, GalSearchType::ACCOUNT(), $galAcctId, $limit
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoCompleteGalRequest '
                        . 'domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAcctId . '" limit="' . $limit . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
