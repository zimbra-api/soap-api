<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetSystemRetentionPolicy;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;

/**
 * Testcase class for GetSystemRetentionPolicy.
 */
class GetSystemRetentionPolicyTest extends ZimbraAdminApiTestCase
{
    public function testGetSystemRetentionPolicyRequest()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);
        $req = new GetSystemRetentionPolicy($cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());
        $req->setCos($cos);
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetSystemRetentionPolicyRequest>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</GetSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSystemRetentionPolicyApi()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);

        $this->api->getSystemRetentionPolicy($cos);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetSystemRetentionPolicyRequest>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:GetSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
