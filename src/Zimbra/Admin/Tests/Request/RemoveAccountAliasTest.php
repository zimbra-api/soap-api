<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RemoveAccountAlias;

/**
 * Testcase class for RemoveAccountAlias.
 */
class RemoveAccountAliasTest extends ZimbraAdminApiTestCase
{
    public function testRemoveAccountAliasRequest()
    {
        $alias = $this->faker->word;
        $id = $this->faker->uuid;

        $req = new RemoveAccountAlias($alias, $id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($alias, $req->getAlias());
        $this->assertEquals($id, $req->getId());
        $req->setAlias($alias)
            ->setId($id);
        $this->assertEquals($alias, $req->getAlias());
        $this->assertEquals($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveAccountAliasRequest alias="' . $alias . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveAccountAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'alias' => $alias,
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountAliasApi()
    {
        $alias = $this->faker->word;
        $id = $this->faker->uuid;
        $this->api->removeAccountAlias($alias, $id);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveAccountAliasRequest alias="' . $alias . '" id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
