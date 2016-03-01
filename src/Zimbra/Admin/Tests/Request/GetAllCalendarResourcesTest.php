<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllCalendarResources;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for GetAllCalendarResources.
 */
class GetAllCalendarResourcesTest extends ZimbraAdminApiTestCase
{
    public function testGetAllCalendarResourcesRequest()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new GetAllCalendarResources($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $req->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllCalendarResourcesRequest>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllCalendarResourcesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllCalendarResourcesApi()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->getAllCalendarResources(
            $server, $domain
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllCalendarResourcesRequest>'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
