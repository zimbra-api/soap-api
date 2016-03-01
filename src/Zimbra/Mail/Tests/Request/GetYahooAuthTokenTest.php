<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetYahooAuthToken;

/**
 * Testcase class for GetYahooAuthToken.
 */
class GetYahooAuthTokenTest extends ZimbraMailApiTestCase
{
    public function testGetYahooAuthTokenRequest()
    {
        $user = $this->faker->word;
        $password = $this->faker->word;
        $req = new GetYahooAuthToken(
            $user, $password
        );
        $this->assertSame($user, $req->getUser());
        $this->assertSame($password, $req->getPassword());

        $req = new GetYahooAuthToken(
            '', ''
        );
        $req->setUser($user)
            ->setPassword($password);
        $this->assertSame($user, $req->getUser());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetYahooAuthTokenRequest user="' . $user . '" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetYahooAuthTokenRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'user' => $user,
                'password' => $password,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetYahooAuthTokenApi()
    {
        $user = $this->faker->word;
        $password = $this->faker->word;
        $this->api->getYahooAuthToken($user, $password);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetYahooAuthTokenRequest user="' . $user . '" password="' . $password . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
