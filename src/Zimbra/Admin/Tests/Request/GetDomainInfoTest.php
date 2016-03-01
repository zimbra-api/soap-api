<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDomainInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for GetDomainInfo.
 */
class GetDomainInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetDomainInfoRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $req = new GetDomainInfo($domain, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getApplyConfig());

        $req->setDomain($domain)
            ->setApplyConfig(true);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDomainInfoRequest applyConfig="true">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetDomainInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDomainInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomainInfoApi()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->getDomainInfo(
            $domain, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDomainInfoRequest applyConfig="true">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetDomainInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
