<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckPasswordStrength;

/**
 * Testcase class for CheckPasswordStrength.
 */
class CheckPasswordStrengthTest extends ZimbraAdminApiTestCase
{
    public function testCheckPasswordStrengthRequest()
    {
        $id = $this->faker->word;
        $password = $this->faker->word;
        $req = new CheckPasswordStrength($id, $password);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $req->setId($id)
            ->setPassword($password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthRequest id="' . $id .'" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckPasswordStrengthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'password' => $password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckPasswordStrengthApi()
    {
        $id = $this->faker->word;
        $password = $this->faker->word;
        $this->api->checkPasswordStrength(
            $id, $password
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckPasswordStrengthRequest '
                        . 'id="' . $id . '" password="' . $password . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
