<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllAccounts;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for GetAllAccounts.
 */
class GetAllAccountsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllAccountsRequest()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new GetAllAccounts($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $req->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAccountsRequest>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllAccountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAccountsRequest' => [
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

    public function testGetAllAccountsApi()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->getAllAccounts(
            $server, $domain
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAccountsRequest>'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllAccountsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
