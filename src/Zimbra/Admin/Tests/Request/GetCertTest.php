<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetCert;
use Zimbra\Enum\CertType;
use Zimbra\Enum\CSRType;

/**
 * Testcase class for GetCert.
 */
class GetCertTest extends ZimbraAdminApiTestCase
{
    public function testGetCertRequest()
    {
        $server = $this->faker->word;
        $req = new GetCert($server, CertType::ALL(), CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame('self', $req->getOption()->value());

        $req->setServer($server)
            ->setType(CertType::MTA())
            ->setOption(CSRType::COMM());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('mta', $req->getType()->value());
        $this->assertSame('comm', $req->getOption()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCertRequest server="' . $server . '" type="' . CertType::MTA() . '" option="' . CSRType::COMM() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCertRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'type' => CertType::MTA()->value(),
                'option' => CSRType::COMM()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCertApi()
    {
        $server = $this->faker->word;
        $this->api->getCert($server, CertType::MTA(), CSRType::COMM());

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCertRequest server="' . $server . '" type="' . CertType::MTA() . '" option="' . CSRType::COMM() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
