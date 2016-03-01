<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteDistributionList;

/**
 * Testcase class for DeleteDistributionList.
 */
class DeleteDistributionListTest extends ZimbraAdminApiTestCase
{
    public function testDeleteDistributionListRequest()
    {
        $id = $this->faker->uuid;
        $req = new DeleteDistributionList($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteDistributionListRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDistributionListApi()
    {
        $id = $this->faker->uuid;
        $this->api->deleteDistributionList(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteDistributionListRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
