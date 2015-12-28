<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteUCService;

/**
 * Testcase class for DeleteUCService.
 */
class DeleteUCServiceTest extends ZimbraAdminApiTestCase
{
    public function testDeleteUCServiceRequest()
    {
        $id = $this->faker->uuid;
        $req = new DeleteUCService($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteUCServiceRequest>'
                . '<id>' . $id . '</id>'
            . '</DeleteUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteUCServiceApi()
    {
        $id = $this->faker->uuid;
        $this->api->deleteUCService(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteUCServiceRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                    . '</urn1:DeleteUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
