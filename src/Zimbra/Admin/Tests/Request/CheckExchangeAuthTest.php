<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckExchangeAuth;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;

/**
 * Testcase class for CheckExchangeAuth.
 */
class CheckExchangeAuthTest extends ZimbraAdminApiTestCase
{
    public function testCheckExchangeAuthRequest()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $auth = new ExchangeAuthSpec(
            $url, $user, $pass, AuthScheme::FORM(), $type
        );
        $req = new CheckExchangeAuth($auth);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($auth, $req->getAuth());

        $req->setAuth($auth);
        $this->assertSame($auth, $req->getAuth());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthRequest>'
                . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
            . '</CheckExchangeAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckExchangeAuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'auth' => [
                    'url' => $url,
                    'user' => $user,
                    'pass' => $pass,
                    'scheme' => AuthScheme::FORM()->value(),
                    'type' => $type,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckExchangeAuthApi()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $auth = new ExchangeAuthSpec(
            $url, $user, $pass, AuthScheme::FORM(), $type
        );

        $this->api->checkExchangeAuth(
            $auth
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckExchangeAuthRequest>'
                        . '<urn1:auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                    . '</urn1:CheckExchangeAuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
