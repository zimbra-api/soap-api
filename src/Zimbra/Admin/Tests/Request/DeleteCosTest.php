<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteCos;

/**
 * Testcase class for DeleteCos.
 */
class DeleteCosTest extends ZimbraAdminApiTestCase
{
    public function testDeleteCosRequest()
    {
        $id = $this->faker->uuid;
        $req = new DeleteCos($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteCosRequest>'
                . '<id>' . $id . '</id>'
            . '</DeleteCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCosApi()
    {
        $id = $this->faker->uuid;
        $this->api->deleteCos(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                    . '</urn1:DeleteCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
