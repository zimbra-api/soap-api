<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RenameCalendarResource;

/**
 * Testcase class for RenameCalendarResource.
 */
class RenameCalendarResourceTest extends ZimbraAdminApiTestCase
{
    public function testRenameCalendarResourceRequest()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;

        $req = new RenameCalendarResource($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameCalendarResourceRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCalendarResourceApi()
    {
        $id = $this->faker->uuid;
        $newName = $this->faker->word;
        $this->api->renameCalendarResource($id, $newName);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameCalendarResourceRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
