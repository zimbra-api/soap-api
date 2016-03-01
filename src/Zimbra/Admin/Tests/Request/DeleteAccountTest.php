<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteAccount;

/**
 * Testcase class for DeleteAccount.
 */
class DeleteAccountTest extends ZimbraAdminApiTestCase
{
    public function testDeleteAccountRequest()
    {
        $id = $this->faker->uuid;
        $req = new DeleteAccount($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteAccountRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteAccountApi()
    {
        $id = $this->faker->uuid;
        $this->api->deleteAccount(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteAccountRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
