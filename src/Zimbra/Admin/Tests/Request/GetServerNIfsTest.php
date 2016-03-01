<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetServerNIfs;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\IpType;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for GetServerNIfs.
 */
class GetServerNIfsTest extends ZimbraAdminApiTestCase
{
    public function testGetServerNIfsRequest()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $req = new GetServerNIfs($server, IpType::BOTH());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('both', $req->getType()->value());

        $req->setServer($server)
            ->setType(IpType::IPV4());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('ipV4', $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerNIfsRequest type="' . IpType::IPV4() . '">'
                . '<server by="name">' . $value . '</server>'
            . '</GetServerNIfsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerNIfsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => IpType::IPV4()->value(),
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerNIfsApi()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $this->api->getServerNIfs($server, IpType::IPV4());

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerNIfsRequest type="' . IpType::IPV4() . '">'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                    . '</urn1:GetServerNIfsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
