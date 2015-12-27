<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetDistributionList;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;

/**
 * Testcase class for GetDistributionList.
 */
class GetDistributionListTest extends ZimbraAccountApiTestCase
{
    public function testGetDistributionListRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $attr = new Attr($name, $value, true);
        $req = new GetDistributionList($dl, false, 'sendToDistList', [$attr]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $this->assertSame($dl, $req->getDl());
        $this->assertFalse($req->getNeedOwners());
        $this->assertSame('sendToDistList', $req->getNeedRights());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setDl($dl)
            ->setNeedOwners(true)
            ->setNeedRights('sendToDistList,viewDistList')
            ->addAttr($attr);
        $this->assertSame($dl, $req->getDl());
        $this->assertTrue($req->getNeedOwners());
        $this->assertSame('sendToDistList,viewDistList', $req->getNeedRights());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListRequest needOwners="true" needRights="sendToDistList,viewDistList">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'needOwners' => true,
                'needRights' => 'sendToDistList,viewDistList',
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'name' => $name,
                        'pd' => true,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionListApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $attr = new Attr($name, $value, true);

        $this->api->getDistributionList($dl, true, 'sendToDistList', [$attr]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListRequest needOwners="true" needRights="sendToDistList">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                    . '</urn1:GetDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
