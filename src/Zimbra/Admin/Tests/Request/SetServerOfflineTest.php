<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SetServerOffline;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for SetServerOffline.
 */
class SetServerOfflineTest extends ZimbraAdminApiTestCase
{
    public function testSetServerOfflineRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $req = new SetServerOffline($server, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());

        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetServerOfflineRequest attrs="' . $attrs . '">'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
            . '</SetServerOfflineRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetServerOfflineRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetServerOfflineApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);

        $this->api->setServerOffline($server, [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetServerOfflineRequest attrs="' . $attrs . '">'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                    . '</urn1:SetServerOfflineRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
