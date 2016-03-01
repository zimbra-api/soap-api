<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetFolder;
use Zimbra\Mail\Struct\GetFolderSpec;

/**
 * Testcase class for GetFolder.
 */
class GetFolderTest extends ZimbraMailApiTestCase
{
    public function testGetFolderRequest()
    {
        $uuid = $this->faker->uuid;
        $l = $this->faker->word;
        $path = $this->faker->word;
        $view = $this->faker->word;
        $depth = mt_rand(1, 10);
		$folder = new GetFolderSpec(
            $uuid, $l, $path
        );

        $req = new GetFolder(
            true, true, $view, $depth, true, $folder
        );
        $this->assertTrue($req->getIsVisible());
        $this->assertTrue($req->getNeedGranteeName());
        $this->assertSame($view, $req->getViewConstraint());
        $this->assertSame($depth, $req->getTreeDepth());
        $this->assertTrue($req->getTraverseMountpoints());
        $this->assertSame($folder, $req->getFolder());

        $req = new GetFolder();
        $req->setFolder($folder)
            ->setIsVisible(true)
            ->setNeedGranteeName(true)
            ->setViewConstraint($view)
            ->setTreeDepth($depth)
            ->setTraverseMountpoints(true);
        $this->assertTrue($req->getIsVisible());
        $this->assertTrue($req->getNeedGranteeName());
        $this->assertSame($view, $req->getViewConstraint());
        $this->assertSame($depth, $req->getTreeDepth());
        $this->assertTrue($req->getTraverseMountpoints());
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFolderRequest visible="true" needGranteeName="true" view="' . $view . '" depth="' . $depth . '" tr="true">'
                .'<folder uuid="' . $uuid . '" l="' . $l . '" path="' . $path . '" />'
            .'</GetFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFolderRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'visible' => true,
                'needGranteeName' => true,
                'view' => $view,
                'depth' => $depth,
                'tr' => true,
                'folder' => array(
                    'uuid' => $uuid,
                    'l' => $l,
                    'path' => $path,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFolderApi()
    {
        $uuid = $this->faker->uuid;
        $l = $this->faker->word;
        $path = $this->faker->word;
        $view = $this->faker->word;
        $depth = mt_rand(1, 10);
        $folder = new GetFolderSpec(
            $uuid, $l, $path
        );

        $this->api->getFolder(
            true, true, $view, $depth, true, $folder
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetFolderRequest visible="true" needGranteeName="true" view="' . $view . '" depth="'  . $depth . '" tr="true">'
                        .'<urn1:folder uuid="' . $uuid . '" l="' . $l . '" path="' . $path . '" />'
                    .'</urn1:GetFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
