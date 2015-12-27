<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetInfo;

/**
 * Testcase class for GetInfo.
 */
class GetInfoTest extends ZimbraAccountApiTestCase
{
    public function testGetInfoRequest()
    {
        $name = $this->faker->word;

        $req = new GetInfo('a,mbox,b,prefs,c', $name);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame('mbox,prefs', $req->getSections());
        $this->assertSame($name, $req->getRights());

        $req->setSections('x,attrs,y,zimlets,z')
            ->setRights($name);
        $this->assertSame('attrs,zimlets', $req->getSections());
        $this->assertSame($name, $req->getRights());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetInfoRequest sections="attrs,zimlets" rights="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'sections' => 'attrs,zimlets',
                'rights' => $name,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetInfoApi()
    {
        $name = $this->faker->word;
        $this->api->getInfo('x,attrs,y,zimlets,z', $name);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetInfoRequest sections="attrs,zimlets" rights="' . $name . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
