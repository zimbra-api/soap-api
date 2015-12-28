<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\UndeployZimlet;

/**
 * Testcase class for UndeployZimlet.
 */
class UndeployZimletTest extends ZimbraAdminApiTestCase
{
    public function testUndeployZimletRequest()
    {
        $name = $this->faker->word;
        $action = $this->faker->word;
        $req = new UndeployZimlet($name, $action);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($action, $req->getAction());
        $req->setName($name)
            ->setAction($action);
        $this->assertSame($name, $req->getName());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UndeployZimletRequest '
                . 'name="' . $name . '" '
                . 'action="' . $action . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UndeployZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'action' => $action,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUndeployZimletApi()
    {
        $name = $this->faker->word;
        $action = $this->faker->word;
        $this->api->undeployZimlet($name, $action);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UndeployZimletRequest name="' . $name . '" action="' . $action . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
