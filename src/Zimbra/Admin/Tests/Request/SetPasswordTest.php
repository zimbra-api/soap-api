<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SetPassword;

/**
 * Testcase class for SetPassword.
 */
class SetPasswordTest extends ZimbraAdminApiTestCase
{
    public function testSetPasswordRequest()
    {
        $id = $this->faker->word;
        $newPassword = $this->faker->word;

        $req = new SetPassword($id, $newPassword);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newPassword, $req->getNewPassword());
        $req->setId($id)
            ->setNewPassword($newPassword);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newPassword, $req->getNewPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetPasswordRequest '
                . 'id="' . $id . '" '
                . 'newPassword="' . $newPassword . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetPasswordRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newPassword' => $newPassword,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetPasswordApi()
    {
        $id = $this->faker->word;
        $newPassword = $this->faker->word;
        $this->api->setPassword($id, $newPassword);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetPasswordRequest id="' . $id . '" newPassword="' . $newPassword . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
