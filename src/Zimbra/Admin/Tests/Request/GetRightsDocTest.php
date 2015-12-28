<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetRightsDoc;
use Zimbra\Admin\Struct\PackageSelector;

/**
 * Testcase class for GetRightsDoc.
 */
class GetRightsDocTest extends ZimbraAdminApiTestCase
{
    public function testGetRightsDocRequest()
    {
        $name = $this->faker->word;
        $package = new PackageSelector($name);
        $req = new GetRightsDoc([$package]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$package], $req->getPackages()->all());

        $req->addPackage($package);
        $this->assertSame([$package, $package], $req->getPackages()->all());
        $req->getPackages()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightsDocRequest>'
                . '<package name="' . $name . '" />'
            . '</GetRightsDocRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightsDocRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'package' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRightsDocApi()
    {
        $name = $this->faker->word;
        $package = new PackageSelector($name);

        $this->api->getRightsDoc([$package]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetRightsDocRequest>'
                        . '<urn1:package name="' . $name . '" />'
                    . '</urn1:GetRightsDocRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
