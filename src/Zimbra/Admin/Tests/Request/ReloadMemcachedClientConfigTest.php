<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ReloadMemcachedClientConfig;

/**
 * Testcase class for ReloadMemcachedClientConfig.
 */
class ReloadMemcachedClientConfigTest extends ZimbraAdminApiTestCase
{
    public function testReloadMemcachedClientConfigRequest()
    {
        $req = new \Zimbra\Admin\Request\ReloadMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReloadMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReloadMemcachedClientConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadMemcachedClientConfigApi()
    {
        $this->api->reloadMemcachedClientConfig();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReloadMemcachedClientConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
