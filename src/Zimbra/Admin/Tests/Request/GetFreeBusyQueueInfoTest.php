<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetFreeBusyQueueInfo;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetFreeBusyQueueInfo.
 */
class GetFreeBusyQueueInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetFreeBusyQueueInfoRequest()
    {
        $name = $this->faker->word;
        $provider = new NamedElement($name);
        $req = new GetFreeBusyQueueInfo($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($provider, $req->getProvider());

        $req->setProvider($provider);
        $this->assertSame($provider, $req->getProvider());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetFreeBusyQueueInfoRequest>'
                . '<provider name="' . $name . '" />'
            . '</GetFreeBusyQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetFreeBusyQueueInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'provider' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFreeBusyQueueInfoApi()
    {
        $name = $this->faker->word;
        $provider = new NamedElement($name);

        $this->api->getFreeBusyQueueInfo(
            $provider
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetFreeBusyQueueInfoRequest>'
                        . '<urn1:provider name="' . $name . '" />'
                    . '</urn1:GetFreeBusyQueueInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
