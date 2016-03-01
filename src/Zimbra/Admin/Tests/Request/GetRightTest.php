<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetRight;

/**
 * Testcase class for GetRight.
 */
class GetRightTest extends ZimbraAdminApiTestCase
{
    public function testGetRightRequest()
    {
        $right = $this->faker->word;
        $req = new GetRight($right, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($right, $req->getRight());
        $this->assertFalse($req->getExpandAllAttrs());

        $req->setRight($right)
            ->setExpandAllAttrs(true);
        $this->assertSame($right, $req->getRight());
        $this->assertTrue($req->getExpandAllAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightRequest expandAllAttrs="true">'
                . '<right>' . $right . '</right>'
            . '</GetRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'right' => $right,
                'expandAllAttrs' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRightApi()
    {
        $right = $this->faker->word;
        $this->api->getRight($right, true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetRightRequest expandAllAttrs="true">'
                        . '<urn1:right>' . $right . '</urn1:right>'
                    . '</urn1:GetRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
