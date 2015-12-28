<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameCos;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for RenameCos.
 */
class RenameCosTest extends ZimbraAdminApiTestCase
{
    public function testRenameCosRequest()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;

        $req = new RenameCos($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameCosRequest>'
                . '<id>' . $id . '</id>'
                . '<newName>' . $newName . '</newName>'
            . '</RenameCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCosApi()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;
        $this->api->renameCos($id, $newName);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:newName>' . $newName . '</urn1:newName>'
                    . '</urn1:RenameCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
