<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AddAccountAlias;

/**
 * Testcase class for AddAccountAlias.
 */
class AddAccountAliasTest extends ZimbraAdminApiTestCase
{
    public function testAddAccountAliasRequest()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;

        $req = new AddAccountAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddAccountAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddAccountAliasApi()
    {
        $id = $this->faker->word;
        $alias = $this->faker->word;
        $this->api->addAccountAlias(
            $id, $alias
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddAccountAliasRequest '
                        . 'id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
