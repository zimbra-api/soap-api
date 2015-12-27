<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\AutoCompleteGal;
use Zimbra\Enum\GalSearchType as SearchType;

/**
 * Testcase class for AutoCompleteGal.
 */
class AutoCompleteGalTest extends ZimbraAccountApiTestCase
{
    public function testAutoCompleteGalRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $limit = mt_rand(0, 100);

        $req = new AutoCompleteGal($name, true, SearchType::ALL(), $id, $limit);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getNeedExp());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame($id, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req->setName($name)
            ->setNeedExp(false)
            ->setType(SearchType::ACCOUNT())
            ->setGalAccountId($id)
            ->setLimit($limit);
        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getNeedExp());
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest '
                . 'needExp="false" name="' . $name . '" type="' . SearchType::ACCOUNT() . '" galAcctId="' . $id . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoCompleteGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'needExp' => false,
                'type' => SearchType::ACCOUNT()->value(),
                'galAcctId' => $id,
                'limit' => $limit,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGalApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $limit = mt_rand(0, 100);

        $this->api->autoCompleteGal(
            $name, true, SearchType::ALL(), $id, $limit
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AutoCompleteGalRequest '
                        . 'needExp="true" name="' . $name . '" type="' . SearchType::ALL() . '" galAcctId="' . $id . '" limit="' . $limit . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
