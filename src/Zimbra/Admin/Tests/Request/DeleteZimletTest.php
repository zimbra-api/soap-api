<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteZimlet;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for DeleteZimlet.
 */
class DeleteZimletTest extends ZimbraAdminApiTestCase
{
    public function testDeleteZimletRequest()
    {
        $name = $this->faker->word;
        $zimlet = new NamedElement($name);
        $req = new DeleteZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());

        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteZimletRequest>'
                . '<zimlet name="' . $name . '" />'
            . '</DeleteZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'zimlet' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteZimletApi()
    {
        $name = $this->faker->word;
        $zimlet = new NamedElement($name);

        $this->api->deleteZimlet(
            $zimlet
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteZimletRequest>'
                        . '<urn1:zimlet name="' . $name . '" />'
                    . '</urn1:DeleteZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
