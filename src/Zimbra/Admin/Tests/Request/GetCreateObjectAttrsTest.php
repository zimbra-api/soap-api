<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetCreateObjectAttrs;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for GetCreateObjectAttrs.
 */
class GetCreateObjectAttrsTest extends ZimbraAdminApiTestCase
{
    public function testGetCreateObjectAttrsRequest()
    {
        $value = $this->faker->word;
        $type = $this->faker->word;
        $target = new TargetWithType($type, $value);
        $cos = new CosSelector(CosBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new GetCreateObjectAttrs($target, $domain, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($cos, $req->getCos());

        $req->setTarget($target)
            ->setDomain($domain)
            ->setCos($cos);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCreateObjectAttrsRequest>'
                . '<target type="' . $type . '">' . $value . '</target>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</GetCreateObjectAttrsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCreateObjectAttrsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => $type,
                    '_content' => $value,
                ],
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCreateObjectAttrsApi()
    {
        $value = $this->faker->word;
        $type = $this->faker->word;
        $target = new TargetWithType($type, $value);
        $cos = new CosSelector(CosBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);


        $this->api->getCreateObjectAttrs($target, $domain, $cos);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCreateObjectAttrsRequest>'
                        . '<urn1:target type="' . $type . '">' . $value . '</urn1:target>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:GetCreateObjectAttrsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
