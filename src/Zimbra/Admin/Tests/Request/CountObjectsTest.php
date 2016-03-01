<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CountObjects;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\CountObjectsType as ObjType;
use Zimbra\Enum\UcServiceBy;

/**
 * Testcase class for CountObjects.
 */
class CountObjectsTest extends ZimbraAdminApiTestCase
{
    public function testCountObjectsRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $req = new CountObjects(ObjType::USER_ACCOUNT(), $domain, $ucservice);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('userAccount', $req->getType()->value());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($ucservice, $req->getUcService());

        $req->setType(ObjType::ACCOUNT())
            ->setDomain($domain)
            ->setUcService($ucservice);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($ucservice, $req->getUcService());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsRequest type="' . ObjType::ACCOUNT() . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</CountObjectsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CountObjectsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => ObjType::ACCOUNT()->value(),
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCountObjectsApi()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->api->countObjects(
            ObjType::ACCOUNT(), $domain, $ucservice
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CountObjectsRequest type="account">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                    . '</urn1:CountObjectsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
