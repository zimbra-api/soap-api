<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RemoveDistributionListAlias;

/**
 * Testcase class for RemoveDistributionListAlias.
 */
class RemoveDistributionListAliasTest extends ZimbraAdminApiTestCase
{
    public function testRemoveDistributionListAliasRequest()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;

        $req = new RemoveDistributionListAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($alias, $req->getAlias());
        $req->setId($id)
            ->setAlias($alias);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDistributionListAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDistributionListAliasApi()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;
        $this->api->removeDistributionListAlias($id, $alias);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
