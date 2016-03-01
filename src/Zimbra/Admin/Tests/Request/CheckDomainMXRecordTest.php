<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckDomainMXRecord;
use Zimbra\Enum\DomainBy;
use Zimbra\Admin\Struct\DomainSelector;

/**
 * Testcase class for CheckDomainMXRecord.
 */
class CheckDomainMXRecordTest extends ZimbraAdminApiTestCase
{
    public function testCheckDomainMXRecordRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $req = new CheckDomainMXRecord($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());

        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDomainMXRecordRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</CheckDomainMXRecordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckDomainMXRecordRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDomainMXRecordApi()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $this->api->checkDomainMXRecord(
            $domain
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckDomainMXRecordRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:CheckDomainMXRecordRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
