<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllDistributionLists;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for GetAllDistributionLists.
 */
class GetAllDistributionListsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllDistributionListsRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new GetAllDistributionLists($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());

        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllDistributionListsRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllDistributionListsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllDistributionListsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDistributionListsApi()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->getAllDistributionLists(
            $domain
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllDistributionListsRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllDistributionListsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
