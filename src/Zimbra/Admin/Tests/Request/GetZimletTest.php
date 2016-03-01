<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetZimlet;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetZimlet.
 */
class GetZimletTest extends ZimbraAdminApiTestCase
{
    public function testGetZimletRequest()
    {
        $name = $this->faker->word;
        $attrs = $this->faker->word;

        $zimlet = new NamedElement($name);
        $req = new GetZimlet($zimlet, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());

        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetZimletRequest attrs="' . $attrs . '">'
                . '<zimlet name="' . $name . '" />'
            . '</GetZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'zimlet' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetZimletApi()
    {
        $name = $this->faker->word;
        $attrs = $this->faker->word;
        $zimlet = new NamedElement($name);

        $this->api->getZimlet(
            $zimlet, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetZimletRequest attrs="' . $attrs . '">'
                        . '<urn1:zimlet name="' . $name . '" />'
                    . '</urn1:GetZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
