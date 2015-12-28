<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckHostnameResolve;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for CheckHostnameResolve.
 */
class CheckHostnameResolveTest extends ZimbraAdminApiTestCase
{
    public function testCheckHostnameResolveRequest()
    {
        $hostname = $this->faker->word;
        $req = new CheckHostnameResolve($hostname);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($hostname, $req->getHostname());
        $req->setHostname($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveRequest hostname="' . $hostname . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckHostnameResolveRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'hostname' => $hostname,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckHostnameResolveApi()
    {
        $hostname = $this->faker->word;
        $this->api->checkHostnameResolve(
            $hostname
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckHostnameResolveRequest '
                        . 'hostname="' . $hostname . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
