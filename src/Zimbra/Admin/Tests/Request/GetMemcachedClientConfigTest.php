<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetMemcachedClientConfig;

/**
 * Testcase class for GetMemcachedClientConfig.
 */
class GetMemcachedClientConfigTest extends ZimbraAdminApiTestCase
{
    public function testGetMemcachedClientConfigRequest()
    {
        $req = new \Zimbra\Admin\Request\GetMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMemcachedClientConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMemcachedClientConfigApi()
    {
        $this->api->getMemcachedClientConfig();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMemcachedClientConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
