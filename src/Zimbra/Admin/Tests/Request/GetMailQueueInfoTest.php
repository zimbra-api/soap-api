<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetMailQueueInfo;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetMailQueueInfo.
 */
class GetMailQueueInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetMailQueueInfoRequest()
    {
        $name = $this->faker->word;
        $server = new NamedElement($name);
        $req = new GetMailQueueInfo($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailQueueInfoRequest>'
                . '<server name="' . $name . '" />'
            . '</GetMailQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailQueueInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailQueueInfoApi()
    {
        $name = $this->faker->word;
        $server = new NamedElement($name);

        $this->api->getMailQueueInfo(
            $server
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailQueueInfoRequest>'
                        . '<urn1:server name="' . $name . '" />'
                    . '</urn1:GetMailQueueInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
