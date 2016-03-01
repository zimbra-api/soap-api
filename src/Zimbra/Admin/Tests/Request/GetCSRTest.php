<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetCSR;
use Zimbra\Enum\CSRType;

/**
 * Testcase class for GetCSR.
 */
class GetCSRTest extends ZimbraAdminApiTestCase
{
    public function testGetCSRRequest()
    {
        $server = $this->faker->word;
        $req = new GetCSR($server, CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('self', $req->getType()->value());

        $req->setServer($server)
            ->setType(CSRType::COMM());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('comm', $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCSRRequest server="' . $server . '" type="' . CSRType::COMM() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCSRRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'type' => CSRType::COMM()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCSRApi()
    {
        $server = $this->faker->word;
        $this->api->getCSR($server, CSRType::COMM());

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCSRRequest server="' . $server . '" type="' . CSRType::COMM() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
