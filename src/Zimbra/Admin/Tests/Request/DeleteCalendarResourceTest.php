<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteCalendarResource;

/**
 * Testcase class for DeleteCalendarResource.
 */
class DeleteCalendarResourceTest extends ZimbraAdminApiTestCase
{
    public function testDeleteCalendarResourceRequest()
    {
        $id = $this->faker->uuid;
        $req = new DeleteCalendarResource($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteCalendarResourceRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCalendarResourceApi()
    {
        $id = $this->faker->uuid;
        $this->api->deleteCalendarResource(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteCalendarResourceRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
