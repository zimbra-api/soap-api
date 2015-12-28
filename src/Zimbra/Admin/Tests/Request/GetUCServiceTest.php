<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetUCService;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;

/**
 * Testcase class for GetUCService.
 */
class GetUCServiceTest extends ZimbraAdminApiTestCase
{
    public function testGetUCServiceRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);
        $req = new GetUCService($ucservice, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($ucservice, $req->getUcService());

        $req->setUcService($ucservice);
        $this->assertSame($ucservice, $req->getUcService());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetUCServiceRequest attrs="' . $attrs . '">'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</GetUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCServiceApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $ucservice = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->api->getUCService($ucservice, [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetUCServiceRequest attrs="' . $attrs . '">'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                    . '</urn1:GetUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
