<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetServer;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for GetServer.
 */
class GetServerTest extends ZimbraAdminApiTestCase
{
    public function testGetServerRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $req = new GetServer($server, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertFalse($req->getApplyConfig());

        $req->setServer($server)
            ->setApplyConfig(true);
        $this->assertSame($server, $req->getServer());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerRequest applyConfig="true" attrs="' . $attrs . '">'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
            . '</GetServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'attrs' => $attrs,
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $this->api->getServer($server, true, [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerRequest applyConfig="true" attrs="' . $attrs . '">'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                    . '</urn1:GetServerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
