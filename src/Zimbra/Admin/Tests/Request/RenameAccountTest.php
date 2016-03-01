<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameAccount;

/**
 * Testcase class for RenameAccount.
 */
class RenameAccountTest extends ZimbraAdminApiTestCase
{
    public function testRenameAccountRequest()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;

        $req = new RenameAccount($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameAccountRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameAccountApi()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;
        $this->api->renameAccount($id, $newName);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameAccountRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
