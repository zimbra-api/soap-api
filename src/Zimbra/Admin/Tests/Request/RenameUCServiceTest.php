<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameUCService;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for RenameUCService.
 */
class RenameUCServiceTest extends ZimbraAdminApiTestCase
{
    public function testRenameUCServiceRequest()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;

        $req = new RenameUCService($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameUCServiceRequest>'
                . '<id>' . $id . '</id>'
                . '<newName>' . $newName . '</newName>'
            . '</RenameUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameUCServiceApi()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;
        $this->api->renameUCService($id, $newName);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameUCServiceRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:newName>' . $newName . '</urn1:newName>'
                    . '</urn1:RenameUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
