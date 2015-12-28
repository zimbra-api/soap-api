<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AddDistributionListAlias;

/**
 * Testcase class for AddDistributionListAlias.
 */
class AddDistributionListAliasTest extends ZimbraAdminApiTestCase
{
    public function testAddDistributionListAliasRequest()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;

        $req = new AddDistributionListAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddDistributionListAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListAliasApi()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;
        $this->api->addDistributionListAlias(
            $id, $alias
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddDistributionListAliasRequest '
                        . 'id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
