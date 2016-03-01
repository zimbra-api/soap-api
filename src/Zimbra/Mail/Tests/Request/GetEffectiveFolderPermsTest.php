<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetEffectiveFolderPerms;
use Zimbra\Mail\Struct\FolderSpec;

/**
 * Testcase class for GetEffectiveFolderPerms.
 */
class GetEffectiveFolderPermsTest extends ZimbraMailApiTestCase
{
    public function testGetEffectiveFolderPermsRequest()
    {
        $l = $this->faker->word;
        $folder = new FolderSpec(
            $l
        );
        $req = new GetEffectiveFolderPerms(
            $folder
        );
        $this->assertSame($folder, $req->getFolder());
        $req->setFolder($folder);
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetEffectiveFolderPermsRequest>'
                .'<folder l="' . $l . '" />'
            .'</GetEffectiveFolderPermsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetEffectiveFolderPermsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'folder' => array(
                    'l' => $l,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetEffectiveFolderPermsApi()
    {
        $l = $this->faker->word;
        $folder = new \Zimbra\Mail\Struct\FolderSpec(
            $l
        );
        $this->api->getEffectiveFolderPerms(
            $folder
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetEffectiveFolderPermsRequest>'
                        .'<urn1:folder l="' . $l . '" />'
                    .'</urn1:GetEffectiveFolderPermsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
