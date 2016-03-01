<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\SubscribeDistributionList;
use Zimbra\Account\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;

/**
 * Testcase class for SubscribeDistributionList.
 */
class SubscribeDistributionListTest extends ZimbraAccountApiTestCase
{
    public function testSubscribeDistributionListRequest()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $req = new SubscribeDistributionList(DLSubscribeOp::UNSUBSCRIBE(), $dl);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame('unsubscribe', $req->getOp()->value());
        $this->assertSame($dl, $req->getDl());

        $req->setOp(DLSubscribeOp::SUBSCRIBE())
            ->setDl($dl);
        $this->assertSame('subscribe', $req->getOp()->value());
        $this->assertSame($dl, $req->getDl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SubscribeDistributionListRequest op="' . DLSubscribeOp::SUBSCRIBE() . '">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
            . '</SubscribeDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SubscribeDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSubscribeDistributionListApi()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $this->api->subscribeDistributionList(DLSubscribeOp::SUBSCRIBE(), $dl);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SubscribeDistributionListRequest op="' . DLSubscribeOp::SUBSCRIBE() . '">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:SubscribeDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
