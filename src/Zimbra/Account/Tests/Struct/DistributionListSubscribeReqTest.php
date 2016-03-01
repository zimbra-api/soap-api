<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Account\Struct\DistributionListSubscribeReq;

/**
 * Testcase class for DistributionListSubscribeReq.
 */
class DistributionListSubscribeReqTest extends ZimbraAccountTestCase
{
    public function testDistributionListSubscribeReq()
    {
        $value = $this->faker->word;
        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE(), $value, false);
        $this->assertTrue($subsReq->getOp()->is('unsubscribe'));
        $this->assertSame($value, $subsReq->getValue());
        $this->assertFalse($subsReq->getBccOwners());

        $subsReq->setOp(DLSubscribeOp::SUBSCRIBE())
                ->setBccOwners(true);
        $this->assertTrue($subsReq->getOp()->is('subscribe'));
        $this->assertTrue($subsReq->getBccOwners());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $subsReq);

        $array = [
            'subsReq' => [
                'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                '_content' => $value,
                'bccOwners' => true,
            ],
        ];
        $this->assertEquals($array, $subsReq->toArray());
    }
}
