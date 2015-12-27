<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetRights;
use Zimbra\Account\Struct\Right;

/**
 * Testcase class for GetRights.
 */
class GetRightsTest extends ZimbraAccountApiTestCase
{
    public function testGetRightsRequest()
    {
        $name = $this->faker->word;

        $ace = new Right($name);
        $req = new GetRights([$ace]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$ace], $req->getAces()->all());

        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());
        $req->getAces()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightsRequest>'
                . '<ace right="' . $name . '" />'
            . '</GetRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ace' => [
                    ['right' => $name],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRightsApi()
    {
        $name = $this->faker->word;
        $ace = new Right($name);

        $this->api->getRights([$ace]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetRightsRequest>'
                        . '<urn1:ace right="' . $name . '" />'
                    . '</urn1:GetRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
