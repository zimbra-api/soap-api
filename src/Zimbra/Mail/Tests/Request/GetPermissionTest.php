<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetPermission;
use Zimbra\Mail\Struct\Right;

/**
 * Testcase class for GetPermission.
 */
class GetPermissionTest extends ZimbraMailApiTestCase
{
    public function testGetPermissionRequest()
    {
        $right = $this->faker->word;
        $ace = new Right($right);
        $req = new GetPermission(
            [$ace]
        );
        $this->assertSame([$ace], $req->getAces()->all());
        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetPermissionRequest>'
                .'<ace right="' . $right . '" />'
                .'<ace right="' . $right . '" />'
            .'</GetPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetPermissionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ace' => array(
                    array(
                        'right' => $right,
                    ),
                    array(
                        'right' => $right,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetPermissionApi()
    {
        $right = $this->faker->word;
        $ace = new Right($right);
        $this->api->getPermission([$ace]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetPermissionRequest>'
                        .'<urn1:ace right="' . $right . '" />'
                    .'</urn1:GetPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
