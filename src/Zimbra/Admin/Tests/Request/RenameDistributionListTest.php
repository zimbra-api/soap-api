<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameDistributionList;

/**
 * Testcase class for RenameDistributionList.
 */
class RenameDistributionListTest extends ZimbraAdminApiTestCase
{
    public function testRenameDistributionListRequest()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;

        $req = new RenameDistributionList($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameDistributionListRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameDistributionListApi()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;
        $this->api->renameDistributionList($id, $newName);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameDistributionListRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
