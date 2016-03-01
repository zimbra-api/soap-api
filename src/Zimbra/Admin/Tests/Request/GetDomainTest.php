<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDomain;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for GetDomain.
 */
class GetDomainTest extends ZimbraAdminApiTestCase
{
    public function testGetDomainRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $req = new GetDomain($domain, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getApplyConfig());

        $req->setDomain($domain)
            ->setApplyConfig(true);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDomainRequest applyConfig="true" attrs="' . $attrs . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'attrs' => $attrs,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomainApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->getDomain(
            $domain, true, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDomainRequest applyConfig="true" attrs="' . $attrs . '">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetDomainRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
