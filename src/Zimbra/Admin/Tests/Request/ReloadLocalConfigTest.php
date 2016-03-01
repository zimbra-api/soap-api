<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ReloadLocalConfig;

/**
 * Testcase class for ReloadLocalConfig.
 */
class ReloadLocalConfigTest extends ZimbraAdminApiTestCase
{
    public function testReloadLocalConfigRequest()
    {
        $req = new \Zimbra\Admin\Request\ReloadLocalConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReloadLocalConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReloadLocalConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadLocalConfigApi()
    {
        $this->api->reloadLocalConfig();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReloadLocalConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
