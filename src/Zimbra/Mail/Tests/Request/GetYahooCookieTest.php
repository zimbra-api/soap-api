<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetYahooCookie;

/**
 * Testcase class for GetYahooCookie.
 */
class GetYahooCookieTest extends ZimbraMailApiTestCase
{
    public function testGetYahooCookieRequest()
    {
        $user = $this->faker->word;
        $req = new GetYahooCookie(
            $user
        );
        $this->assertSame($user, $req->getUser());

        $req = new GetYahooCookie('');
        $req->setUser($user);
        $this->assertSame($user, $req->getUser());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetYahooCookieRequest user="' . $user . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetYahooCookieRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'user' => $user,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetYahooCookieApi()
    {
        $user = $this->faker->word;
        $this->api->getYahooCookie($user);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetYahooCookieRequest user="' . $user . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
